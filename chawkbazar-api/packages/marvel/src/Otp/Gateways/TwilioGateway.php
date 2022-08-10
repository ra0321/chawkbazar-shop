<?php


namespace Marvel\Otp\Gateways;

use Illuminate\Support\Facades\Log;
use Marvel\Otp\OtpInterface;
use Marvel\Otp\Result;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;


class TwilioGateway implements OtpInterface
{

	/**
	 * @var Client
	 */
	private $client;


	/**
	 * @var string
	 */
	private $verification_sid;


	/**
	 * Verification constructor.
	 * @param $client
	 * @param string|null $verification_sid
	 * @throws \Twilio\Exceptions\ConfigurationException
	 */
	public function __construct($client = null, string $verification_sid = null)
	{
		if ($client === null) {
			$sid = config('services.twilio.account_sid');
			$token = config('services.twilio.auth_token');
			$client = new Client($sid, $token);
		}
		$this->client = $client;
		$this->verification_sid = $verification_sid ?: config('services.twilio.verification_sid');
	}


	/**
	 * Start a phone verification process using Twilio Verify V2 API
	 *
	 * @param $phone_number
	 * @return Result
	 */
	public function startVerification($phone_number)
	{
		try {
			$verification = $this->client->verify->v2->services($this->verification_sid)
				->verifications
				->create($phone_number, 'sms');
			return new Result($verification->sid);
		} catch (TwilioException $exception) {
			return new Result(["Verification failed to start: {$exception->getMessage()}"]);
		}
	}

	/**
	 * Check verification code using Twilio Verify V2 API
	 *
	 * @param $phone_number
	 * @param $code
	 * @return Result
	 */
	public function checkVerification($id, $code, $phone_number)
	{
		try {
			$verification_check = $this->client->verify->v2->services($this->verification_sid)
				->verificationChecks
				->create($code, ['to' => $phone_number]);
			if ($verification_check->status === 'approved') {
				return new Result($verification_check->sid);
			}
			return new Result(['Verification check failed: Invalid code.']);
		} catch (TwilioException $exception) {
			return new Result(["Verification check failed: {$exception->getMessage()}"]);
		}
	}
}
