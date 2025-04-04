<?php

interface InControlle
{
    public function view();
    public function response_json();
    public function request_body();
    public function request_http();
    public function refresh();
}
