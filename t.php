<?php
if (extension_loaded('pdo_mysql')) {
    echo "PDO MySQL etkin!";
} else {
    echo "PDO MySQL etkin değil!";
}
