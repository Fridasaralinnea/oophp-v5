<?php

namespace Fla\Content;

/**
 * A trait for validating ip-addresses.
 */
trait MyContentTrait
{
    /**
     * @var bool $validIPv4  Bool if Ip-address is IPv4 valid.
     * @var bool $validIPv6  Bool if Ip-address is IPv6 valid.
     */
    // private $db = $this->app->db;


    /**
     * SELECT * FROM content.
     *
     * @return void.
     */
    public function getAll()
    {
        $db = $this->app->db;

        $db->connect();

        $sql = "SELECT * FROM content;";
        $res = $db->executeFetchAll($sql);

        return $res;
    }

    /**
     * SELECT * FROM content WHERE type = page.
     *
     * @return void.
     */
    public function getPages()
    {
        $db = $this->app->db;

        $db->connect();

        $sql = <<< EOD
        SELECT
            *,
            CASE
                WHEN (deleted <= NOW()) THEN "isDeleted"
                WHEN (published <= NOW()) THEN "isPublished"
                ELSE "notPublished"
            END AS status
        FROM content
        WHERE
            type = ?
        ;
        EOD;

        $res = $db->executeFetchAll($sql, ["page"]);

        return $res;
    }

    /**
     * SELECT * FROM content WHERE type = page and route = ?.
     *
     * @return void.
     */
    public function getPage($route)
    {
        $db = $this->app->db;

        $db->connect();

        $sql = <<< EOD
        SELECT
            *,
            CASE
                WHEN (deleted <= NOW()) THEN "isDeleted"
                WHEN (published <= NOW()) THEN "isPublished"
                ELSE "notPublished"
            END AS status
        FROM content
        WHERE
            type = ? and path = ?
        ;
        EOD;

        $res = $db->executeFetchAll($sql, ["page", $route]);

        return $res[0];
    }

    /**
     * SELECT * FROM content WHERE type = post.
     *
     * @return void.
     */
    public function getPosts()
    {
        $db = $this->app->db;

        $db->connect();

        $sql = <<<EOD
        SELECT
            *,
            DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
            DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
        FROM content
        WHERE type = ?
        ORDER BY published DESC
        ;
        EOD;

        $res = $db->executeFetchAll($sql, ["post"]);

        return $res;
    }

    /**
     * SELECT * FROM content WHERE type = post and slug = ?.
     *
     * @return void.
     */
    public function getPost($slug)
    {
        $db = $this->app->db;

        $db->connect();

        $sql = <<<EOD
        SELECT
            *,
            DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
            DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
        FROM content
        WHERE type = ? and slug = ?
        ;
        EOD;

        $res = $db->executeFetchAll($sql, ["post", $slug]);

        return $res;
    }

    /**
     * SELECT * FROM content WHERE id = id.
     *
     * @return void.
     */
    public function getById($id)
    {
        $db = $this->app->db;

        $db->connect();

        $sql = <<< EOD
        SELECT
            *
        FROM content
        WHERE
            id = ?
        ;
        EOD;

        $res = $db->executeFetchAll($sql, [$id]);

        return $res[0];
    }


    /**
     * UPDATE content WHERE id = id.
     *
     * @return void.
     */
    public function deleteById($id)
    {
        $db = $this->app->db;

        $db->connect();

        $sql = <<< EOD
        UPDATE
            content
        SET deleted = CURRENT_TIMESTAMP
        WHERE
            id = ?
        ;
        EOD;

        $db->executeFetchAll($sql, [$id]);

        return;
    }



    /**
     * UPDATE content WHERE id = id.
     *
     * @return void.
     */
    public function editById($contentId, $contentTitle, $contentPath, $contentSlug, $contentData, $contentType, $contentFilter, $contentPublish)
    {
        $db = $this->app->db;

        $db->connect();

        $sql = <<< EOD
        UPDATE
            content
        SET title = ?, path = ?, slug = ?, data = ?, type = ?, filter = ?, published = ?
        WHERE
            id = ?
        ;
        EOD;

        $db->executeFetchAll($sql, [$contentTitle, $contentPath, $contentSlug, $contentData, $contentType, $contentFilter, $contentPublish, $contentId]);

        return;
    }


    /**
     * INSERT INTO content.
     *
     * @return void.
     */
    public function createContent($title)
    {
        $db = $this->app->db;

        $db->connect();

        $sql = <<< EOD
        INSERT INTO
            content (title)
        VALUES
            (?)
        ;
        EOD;

        $db->executeFetchAll($sql, [$title]);
        $id = $db->lastInsertId();

        return $id;
    }


    //
    // /**
    //  * SELECT * FROM movies WHERE title LIKE ?.
    //  *
    //  * @return void.
    //  */
    // public function searchTitle($title)
    // {
    //     $db = $this->app->db;
    //
    //     $db->connect();
    //
    //     $sql = <<< EOD
    //     SELECT
    //         *
    //     FROM movie
    //     WHERE
    //         title LIKE ?
    //     ;
    //     EOD;
    //     $res = $db->executeFetchAll($sql, [$title]);
    //
    //     return $res;
    // }
    //
    //
    // /**
    //  * SELECT * FROM movies WHERE year BETWEEN year1 AND year2.
    //  *
    //  * @return void.
    //  */
    // public function searchYear($year1, $year2)
    // {
    //     $db = $this->app->db;
    //
    //     $db->connect();
    //
    //     $sql = <<< EOD
    //     SELECT
    //         *
    //     FROM movie
    //     WHERE
    //         year BETWEEN ? AND ?
    //     ;
    //     EOD;
    //     $res = $db->executeFetchAll($sql, [$year1, $year2]);
    //
    //     return $res;
    // }
    //
    //
    // /**
    //  * DELETE FROM movies WHERE id = id.
    //  *
    //  * @return void.
    //  */
    // public function deleteMovie($id)
    // {
    //     $db = $this->app->db;
    //
    //     $db->connect();
    //
    //     $sql = <<< EOD
    //     DELETE
    //     FROM movie
    //     WHERE
    //         id = ?
    //     ;
    //     EOD;
    //
    //     $db->executeFetchAll($sql, [$id]);
    //
    //     return;
    // }
    //
    //
    // /**
    //  * SELECT * FROM movies WHERE id = id.
    //  *
    //  * @return void.
    //  */
    // public function getMovie($id)
    // {
    //     $db = $this->app->db;
    //
    //     $db->connect();
    //
    //     $sql = <<< EOD
    //     SELECT
    //         *
    //     FROM movie
    //     WHERE
    //         id = ?
    //     ;
    //     EOD;
    //
    //     $res = $db->executeFetchAll($sql, [$id]);
    //
    //     return $res[0];
    // }
    //
    //
    // /**
    //  * UPDATE movie WHERE id = id.
    //  *
    //  * @return void.
    //  */
    // public function updateMovie($id, $title, $image, $year)
    // {
    //     $db = $this->app->db;
    //
    //     $db->connect();
    //
    //     $sql = <<< EOD
    //     UPDATE
    //         movie
    //     SET title = ?, image = ?, year = ?
    //     WHERE
    //         id = ?
    //     ;
    //     EOD;
    //
    //     $db->executeFetchAll($sql, [$title, $image, $year, $id]);
    //
    //     return;
    // }
    //
    //
    // /**
    //  * INSERT INTO movie.
    //  *
    //  * @return void.
    //  */
    // public function addMovie($title, $image, $year)
    // {
    //     $db = $this->app->db;
    //
    //     $db->connect();
    //
    //     $sql = <<< EOD
    //     INSERT INTO
    //         movie (title, image, year)
    //     VALUES
    //         (?, ?, ?)
    //     ;
    //     EOD;
    //
    //     $db->executeFetchAll($sql, [$title, $image, $year]);
    //
    //     return;
    // }


    /**
     * DROP and CREATE movie.
     *
     * @return void.
     */
    public function resetContent()
    {
        $db = $this->app->db;

        $db->connect();

        $sql1 = <<< EOD
        DROP TABLE IF EXISTS `content`;
        EOD;

        $sql2 = <<< EOD
        CREATE TABLE `content`
        (
          `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
          `path` CHAR(120) UNIQUE,
          `slug` CHAR(120) UNIQUE,

          `title` VARCHAR(120),
          `data` TEXT,
          `type` CHAR(20),
          `filter` VARCHAR(80) DEFAULT NULL,

          `published` DATETIME DEFAULT CURRENT_TIMESTAMP,
          `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
          `updated` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,

          `deleted` DATETIME DEFAULT NULL
        ) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;
        EOD;

        $sql3 = <<< EOD
        INSERT INTO `content` (`path`, `slug`, `type`, `title`, `data`, `filter`) VALUES
            ("hem", null, "page", "Hem", "Detta är min hemsida. Den är skriven i [url=http://en.wikipedia.org/wiki/BBCode]bbcode[/url] vilket innebär att man kan formattera texten till [b]bold[/b] och [i]kursiv stil[/i] samt hantera länkar.\n\nDessutom finns ett filter 'nl2br' som lägger in <br>-element istället för \\n, det är smidigt, man kan skriva texten precis som man tänker sig att den skall visas, med radbrytningar.", "bbcode,nl2br"),
            ("om", null, "page", "Om", "Detta är en sida om mig och min webbplats. Den är skriven i [Markdown](http://en.wikipedia.org/wiki/Markdown). Markdown innebär att du får bra kontroll över innehållet i din sida, du kan formattera och sätta rubriker, men du behöver inte bry dig om HTML.\n\nRubrik nivå 2\n-------------\n\nDu skriver enkla styrtecken för att formattera texten som **fetstil** och *kursiv*. Det finns ett speciellt sätt att länka, skapa tabeller och så vidare.\n\n###Rubrik nivå 3\n\nNär man skriver i markdown så blir det läsbart även som textfil och det är lite av tanken med markdown.", "markdown"),
            ("blogpost-1", "valkommen-till-min-blogg", "post", "Välkommen till min blogg!", "Detta är en bloggpost.\n\nNär det finns länkar till andra webbplatser så kommer de länkarna att bli klickbara.\n\nhttp://dbwebb.se är ett exempel på en länk som blir klickbar.", "link,nl2br"),
            ("blogpost-2", "nu-har-sommaren-kommit", "post", "Nu har sommaren kommit", "Detta är en bloggpost som berättar att sommaren har kommit, ett budskap som kräver en bloggpost.", "nl2br"),
            ("blogpost-3", "nu-har-hosten-kommit", "post", "Nu har hösten kommit", "Detta är en bloggpost som berättar att sommaren har kommit, ett budskap som kräver en bloggpost", "nl2br");
        EOD;

        $db->executeFetchAll($sql1);
        $db->executeFetchAll($sql2);
        $db->executeFetchAll($sql3);

        return;
    }


    /**
     * get, set session.
     *
     * @return void.
     */
    public function getSetSession($name)
    {
        $session = $this->app->session;

        $res = $session->get($name);
        $session->set($name, null);

        return $res;
    }
}
