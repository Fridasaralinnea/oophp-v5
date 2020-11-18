<?php

namespace Fla\Movie;

/**
 * A trait for validating ip-addresses.
 */
trait MovieTrait
{
    /**
     * @var bool $validIPv4  Bool if Ip-address is IPv4 valid.
     * @var bool $validIPv6  Bool if Ip-address is IPv6 valid.
     */
    // private $db = $this->app->db;


    /**
     * SELECT * FROM movies.
     *
     * @return void.
     */
    public function getAll()
    {
        $db = $this->app->db;

        $db->connect();

        $sql = "SELECT * FROM movie;";
        $res = $db->executeFetchAll($sql);

        return $res;
    }

    /**
     * SELECT * FROM movies WHERE title LIKE ?.
     *
     * @return void.
     */
    public function searchTitle($title)
    {
        $db = $this->app->db;

        $db->connect();

        $sql = <<< EOD
        SELECT
            *
        FROM movie
        WHERE
            title LIKE ?
        ;
        EOD;
        $res = $db->executeFetchAll($sql, [$title]);

        return $res;
    }


    /**
     * SELECT * FROM movies WHERE year BETWEEN year1 AND year2.
     *
     * @return void.
     */
    public function searchYear($year1, $year2)
    {
        $db = $this->app->db;

        $db->connect();

        $sql = <<< EOD
        SELECT
            *
        FROM movie
        WHERE
            year BETWEEN ? AND ?
        ;
        EOD;
        $res = $db->executeFetchAll($sql, [$year1, $year2]);

        return $res;
    }


    /**
     * DELETE FROM movies WHERE id = id.
     *
     * @return void.
     */
    public function deleteMovie($id)
    {
        $db = $this->app->db;

        $db->connect();

        $sql = <<< EOD
        DELETE
        FROM movie
        WHERE
            id = ?
        ;
        EOD;

        $db->executeFetchAll($sql, [$id]);

        return;
    }


    /**
     * SELECT * FROM movies WHERE id = id.
     *
     * @return void.
     */
    public function getMovie($id)
    {
        $db = $this->app->db;

        $db->connect();

        $sql = <<< EOD
        SELECT
            *
        FROM movie
        WHERE
            id = ?
        ;
        EOD;

        $res = $db->executeFetchAll($sql, [$id]);

        return $res[0];
    }


    /**
     * UPDATE movie WHERE id = id.
     *
     * @return void.
     */
    public function updateMovie($id, $title, $image, $year)
    {
        $db = $this->app->db;

        $db->connect();

        $sql = <<< EOD
        UPDATE
            movie
        SET title = ?, image = ?, year = ?
        WHERE
            id = ?
        ;
        EOD;

        $db->executeFetchAll($sql, [$title, $image, $year, $id]);

        return;
    }


    /**
     * INSERT INTO movie.
     *
     * @return void.
     */
    public function addMovie($title, $image, $year)
    {
        $db = $this->app->db;

        $db->connect();

        $sql = <<< EOD
        INSERT INTO
            movie (title, image, year)
        VALUES
            (?, ?, ?)
        ;
        EOD;

        $db->executeFetchAll($sql, [$title, $image, $year]);

        return;
    }


    /**
     * DROP and CREATE movie.
     *
     * @return void.
     */
    public function resetMovie()
    {
        $db = $this->app->db;

        $db->connect();

        $sql1 = <<< EOD
        DROP TABLE IF EXISTS `movie`;
        EOD;

        $sql2 = <<< EOD
        CREATE TABLE `movie`
        (
            `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
            `title` VARCHAR(100) NOT NULL,
            `director` VARCHAR(100),
            `length` INT DEFAULT NULL,
            `year` INT NOT NULL DEFAULT 1900,
            `plot` TEXT,
            `image` VARCHAR(100) DEFAULT NULL,
            `subtext` CHAR(3) DEFAULT NULL,
            `speech` CHAR(3) DEFAULT NULL,
            `quality` CHAR(3) DEFAULT NULL,
            `format` CHAR(3) DEFAULT NULL
        ) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;
        EOD;

        $sql3 = <<< EOD
        DELETE FROM `movie`;
        EOD;

        $sql4 = <<< EOD
        INSERT INTO `movie` (`title`, `year`, `image`) VALUES
            ('Pulp fiction', 1994, 'img/pulp-fiction.jpg'),
            ('American Pie', 1999, 'img/american-pie.jpg'),
            ('Pokémon The Movie 2000', 1999, 'img/pokemon.jpg'),
            ('Kopps', 2003, 'img/kopps.jpg'),
            ('From Dusk Till Dawn', 1996, 'img/from-dusk-till-dawn.jpg')
        ;
        EOD;

        $db->executeFetchAll($sql1);
        $db->executeFetchAll($sql2);
        $db->executeFetchAll($sql3);
        $db->executeFetchAll($sql4);

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



    // /**
    //  * Set vars to false.
    //  *
    //  * @return void.
    //  */
    // public function setToFalse()
    // {
    //     $this->validIPv4 = false;
    //     $this->validIPv6 = false;
    // }
    //
    // /**
    //  * Validate ip-address for IPv4 and IPv6.
    //  *
    //  * @return void.
    //  */
    // public function validateIp($ip)
    // {
    //     if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
    //         $this->validIPv4 = true;
    //     } elseif (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
    //         $this->validIPv6 = true;
    //     } else {
    //         $this->validIPv4 = false;
    //         $this->validIPv6 = false;
    //     }
    // }
    //
    // /**
    //  * Get validIPv4.
    //  *
    //  * @return bool for validIPv4.
    //  */
    // public function getIPv4()
    // {
    //     return $this->validIPv4;
    // }
    //
    // /**
    //  * Get validIPv6.
    //  *
    //  * @return bool for validIPv6.
    //  */
    // public function getIPv6()
    // {
    //     return $this->validIPv6;
    // }
    //
    // /**
    //  * Get Domain for ip-address.
    //  *
    //  * @return string for domain.
    //  */
    // public function getDomain($ip)
    // {
    //     if ($this->validIPv4) {
    //         $domain = gethostbyaddr($ip);
    //     } elseif ($this->validIPv6) {
    //         $domain = gethostbyaddr($ip);
    //     } else {
    //         $domain = "";
    //     }
    //     return $domain;
    // }
}
