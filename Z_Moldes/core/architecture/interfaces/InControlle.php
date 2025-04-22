<?php

interface InControlle
{
    public function view(string $view, array $data = []);
    public function response_json($data_response, int $status_code = 200);
    //public function request_body();
    //public function request_http();
    public function refresh(string $routeUrl);
}
