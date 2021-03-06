<?php


namespace App\Constants;


class HttpStatusCodes
{
    const NOT_FOUND=404;
    const GONE = 410;
    const CONFLICT = 409;
    const BAD_REQUEST = 400;
    const OK = 200;
    const TOO_MANY_REQUESTS = 429;
    const TEMPORARY_REDIRECT = 302;
    const PERMANENT_REDIRECT = 301;
    const NOT_ACCEPTABLE = 406;
}
