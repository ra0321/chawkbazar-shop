<?php


namespace Marvel\Otp;


interface OtpInterface
{
    /**
     * Start a phone verification process using an external service
     *
     * @param $phone_number
     * @return Result
     */
    public function startVerification($phone_number);


    /**
     * Check verification code using an external service
     *
     * @param $id
     * @param $code
     * @param $phone_number
     * @return Result
     */
    public function checkVerification($id, $code, $phone_number);
}
