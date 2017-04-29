<?php


namespace model\settings;


class HeaderTypes {
    const OK = "HTTP/1.0 200 OK";
    const CREATED = "HTTP/1.0 201 Created";

    const BAD_REQUEST = "HTTP/1.0 400 Bad Request";
    const UNAUTHORIZED = "HTTP/1.0 401 Unauthorized";
    const PAYMENT_REQUIRED = "HTTP/1.0 402 Payment Required";
    const FORBIDDEN = "HTTP/1.0 403 Forbidden";
    const NOT_FOUND = "HTTP/1.0 404 Not Found";
}