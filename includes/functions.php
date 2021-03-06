<?php

    /**
     * functions.php
     *
     * FOPortal
     * v.0.1
     *
     * Helper functions.
     */

    require_once("constants.php");

    // ensure string contains only alphabetic characters
    function validate_text_plus($str)
    {
        $valid = array("-", " ");
        if (ctype_alpha(str_replace($valid, "", $str)))
        {
            return true;
        }
        return false;
    };

    // ensure string contains only four integers
    function validate_class_year($str)
    {
        $valid = array("");
        if (ctype_digit(str_replace($valid, "", $str)) && strlen($str) == 4)
        {
            return true;
        }
        return false;
    }; 

    // ensure string contains only alphabetic characters
    function validate_alpha($str)
    {
        $valid = array("");
        if (ctype_alnum(str_replace($valid, "", $str)))
        {
            return true;
        }
        return false;
    };  

    // ensure string is a valid house
    function validate_house($str, $houses)
    {
        if (in_array($str, $houses))
        {
            return true;
        }
        return false;
    }

    /**
     * Apologizes to user with message.
     */
    function apologize($message)
    {
        render("apology.php", array("message" => $message));
        exit;
    }

    /**
     * Facilitates debugging by dumping contents of variable
     * to browser.
     */
    function dump($variable)
    {
        require("../templates/dump.php");
        exit;
    }

    /**
     * Logs out current user, if any.  Based on Example #1 at
     * http://us.php.net/manual/en/function.session-destroy.php.
     */
    function logout()
    {
        // unset any session variables
        $_SESSION = array();

        // expire cookie
        if (!empty($_COOKIE[session_name()]))
        {
            setcookie(session_name(), "", time() - 42000);
        }

        // destroy session
        session_destroy();
    }

    /**
     * Executes SQL statement, possibly with parameters, returning
     * an array of all rows in result set or false on (non-fatal) error.
     */
    function query(/* $sql [, ... ] */)
    {
        // SQL statement
        $sql = func_get_arg(0);

        // parameters, if any
        $parameters = array_slice(func_get_args(), 1);

        // try to connect to database
        static $handle;
        if (!isset($handle))
        {
            try
            {
                // connect to database
                $handle = new PDO("mysql:dbname=" . DATABASE . ";host=" . SERVER, USERNAME, PASSWORD);

                // ensure that PDO::prepare returns false when passed invalid SQL
                $handle->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 
            }
            catch (Exception $e)
            {
                // trigger (big, orange) error
                trigger_error($e->getMessage(), E_USER_ERROR);
                exit;
            }
        }

        // prepare SQL statement
        $statement = $handle->prepare($sql);
        if ($statement === false)
        {
            // trigger (big, orange) error
            $tmp = $handle->errorInfo();
            trigger_error($tmp[2], E_USER_ERROR);
            exit;
        }

        // execute SQL statement
        $results = $statement->execute($parameters);

        // return result set's rows, if any
        if ($results !== false)
        {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else
        {
            return false;
        }
    }

    /**
     * Redirects user to destination, which can be
     * a URL or a relative path on the local host.
     *
     * Because this function outputs an HTTP header, it
     * must be called before caller outputs any HTML.
     */
    function redirect($destination)
    {
        // handle URL
        if (preg_match("/^https?:\/\//", $destination))
        {
            header("Location: " . $destination);
        }

        // handle absolute path
        else if (preg_match("/^\//", $destination))
        {
            $protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
            $host = $_SERVER["HTTP_HOST"];
            header("Location: $protocol://$host$destination");
        }

        // handle relative path
        else
        {
            // adapted from http://www.php.net/header
            $protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
            $host = $_SERVER["HTTP_HOST"];
            $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
            header("Location: $protocol://$host$path/$destination");
        }

        // exit immediately since we're redirecting anyway
        exit;
    }

    /**
     * Renders template, passing in values.
     */
    function render($template, $values = array())
    {
        // if template exists, render it
        if (file_exists("templates/$template"))
        {
            // extract variables into local scope
            extract($values);

            // render header
            require("templates/header.php");

            // render template
            require("templates/$template");

            // render footer
            require("templates/footer.php");
        }

        // else err
        else
        {
            trigger_error("Invalid template: $template", E_USER_ERROR);
        }
    }

?>
