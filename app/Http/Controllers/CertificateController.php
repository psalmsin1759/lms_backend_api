<?php

namespace App\Http\Controllers;

use App\Application\Services\CertificateService;
use App\Http\Requests\Certificate\IssueCertificateRequest;
use App\Http\Requests\Certificate\VerifyCertificateRequest;
use App\Utils\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function __construct(
        private CertificateService $service
    ) {}

    /**
     * Issue a certificate to a user for a course
     */
    public function issue(IssueCertificateRequest $request): JsonResponse
    {
        $data = $request->validated();

        $certificate = $this->service->issue(
            userId: $data['user_id'],
            courseId: $data['course_id']
        );

        return ApiResponse::success(
            $certificate,
            'Certificate issued successfully',
            201
        );
    }

    /**
     * Get certificates for authenticated user
     */
    public function myCertificates(Request $request): JsonResponse
    {
        $certificates = $this->service->getUserCertificates($request->user()->id);

        return ApiResponse::success(
            $certificates,
            'Certificates retrieved successfully'
        );
    }

    /**
     * Reissue a certificate
     */
    public function reissue(int $id): JsonResponse
    {
        $certificate = $this->service->reissue($id);

        return ApiResponse::success(
            $certificate,
            'Certificate reissued successfully'
        );
    }

    /**
     * Revoke a certificate
     */
    public function revoke(int $id): JsonResponse
    {
        $this->service->revoke($id);

        return ApiResponse::success(
            null,
            'Certificate revoked successfully'
        );
    }

    /**
     * Verify certificate by certificate number (public)
     */
    public function verify(VerifyCertificateRequest $request): JsonResponse
    {
        $isValid = $this->service->verify($request->certificate_number);

        return ApiResponse::success(
            ['valid' => $isValid],
            $isValid ? 'Certificate is valid' : 'Certificate is invalid'
        );
    }
}
