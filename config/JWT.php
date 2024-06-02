<?php

class config_JWT{
    static $jwt_secret_key="75443b3efe89f2422486092f155837afe4b11002803f2948ea4f875ccc4b5e57";
    static $jwt_issuer="super3_backend";
    static $jwt_audience="super3_frontend";
    static $jwt_algorithm="HS256";
    static $jwt_not_before=0;
    static $jwt_expire_after=60*60;
}

?>