<?php

namespace App\Repositories\Interefaces\AdminDashboard;

interface InvoiceFeesRepositoryInterface
{
        public function index();

        public function show($id);

        public function store($request);

        public function edit($invoiceFee);

        public function update($request);

        public function delete($request);
}
