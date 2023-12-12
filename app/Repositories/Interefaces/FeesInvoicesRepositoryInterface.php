<?php

namespace App\Repositories\Interefaces;

interface FeesInvoicesRepositoryInterface
{
        public function index();

        public function show($id);

        public function store($request);

        public function edit($id);

        public function update($request);

        public function delete($request);
}
