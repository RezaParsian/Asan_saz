@extends('layouts.auth')

@section('title',"تایید ایمیل")

@section('content')
    <table
        style="font-family: Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #eaf0f7; margin: 0; line-height: 2; direction: rtl;"
        bgcolor="#eaf0f7">
        <tr style="box-sizing: border-box; margin: 0;">
            <td style="box-sizing: border-box; vertical-align: top; display: block !important; max-width: 500px !important; clear: both !important; margin: 0 auto;"
                valign="top">
                <div style="box-sizing: border-box; max-width: 500px; display: block; margin: 0 auto; padding: 0 0;">
                    <table width="100%" cellpadding="0" cellspacing="0" itemprop="action" itemscope
                        itemtype="http://schema.org/ConfirmAction"
                        style="box-sizing: border-box; border-radius: 3px; background-color: #fff; margin: 0; border: 1px dashed #4d79f6;"
                        bgcolor="#fff">
                        <tr style="box-sizing: border-box; margin: 0;">
                            <td style="box-sizing: border-box; vertical-align: top; margin: 0; padding: 20px;" valign="top">
                                <meta itemprop="name" content="Confirm Email" style="box-sizing: border-box; margin: 0;">
                                <table width="100%" cellpadding="0" cellspacing="0"
                                    style="box-sizing: border-box; margin: 0;">
                                    <tr style="box-sizing: border-box; margin: 0;">
                                        <td style="box-sizing: border-box; color: #5867dd; font-size: 24px; font-weight: 700; text-align: center; vertical-align: top; margin: 0; padding: 0 0 10px;"
                                            valign="top">{{ env('APP_NAME') }}</td>
                                    </tr>
                                    <tr style="box-sizing: border-box; margin: 0;">
                                        <td style="box-sizing: border-box; color: #3f5db3; vertical-align: top; margin: 0; padding: 10px 10px;"
                                            valign="top">لطفا با کلیک بر روی لینک زیر ایمیل خود را تایید کنید.</td>
                                    </tr>
                                    <tr style="box-sizing: border-box; margin: 0;">
                                        <td style="box-sizing: border-box; vertical-align: top; margin: 0; padding: 10px 10px;"
                                            valign="top">ما نیاز به ارسال اطلاعات حساس سرویسمان به ایمیل شما داریم. لذا وارد
                                            کردن ایمیل صحیح اهمیت بالایی دارد.</td>
                                    </tr>
                                    <tr style="box-sizing: border-box; margin: 0;">
                                        <td itemprop="handler" itemscope itemtype="http://schema.org/HttpActionHandler"
                                            style="box-sizing: border-box; vertical-align: top; margin: 0; padding: 10px 10px;"
                                            valign="top">
                                            <form class="d-inline" method="POST"
                                                action="{{ route('verification.resend') }}">
                                                @csrf
                                                <button type="submit" class="btn-block"
                                                    style="box-sizing: border-box; color: #FFF; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: block; border-radius: 5px; text-transform: capitalize; background-color: #5867dd; margin: 0; border-color: #5867dd; border-style: solid; border-width: 10px 20px;">تایید
                                                    آدرس ایمیل</button>
                                            </form>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
@endsection
