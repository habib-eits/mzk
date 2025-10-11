<?php

namespace App\Http\Controllers;

use App\Models\QuotationDetail;
use App\Http\Requests\StoreQuotationDetailRequest;
use App\Http\Requests\UpdateQuotationDetailRequest;

class QuotationDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreQuotationDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuotationDetailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QuotationDetail  $quotationDetail
     * @return \Illuminate\Http\Response
     */
    public function show(QuotationDetail $quotationDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QuotationDetail  $quotationDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(QuotationDetail $quotationDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateQuotationDetailRequest  $request
     * @param  \App\Models\QuotationDetail  $quotationDetail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuotationDetailRequest $request, QuotationDetail $quotationDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuotationDetail  $quotationDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuotationDetail $quotationDetail)
    {
        //
    }
}
