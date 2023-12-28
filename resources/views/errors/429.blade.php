@extends('errors::minimal')

@section('title', __('Too Many Requests'))
@section('code', 'خطای شماره 429')
@section('message', 'تعداد درخواست ها خیلی زیاد شده است.')
