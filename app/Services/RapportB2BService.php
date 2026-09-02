<?php
namespace App\Services;
use App\Mail\RapportB2BCreatedMail;
use App\Repositories\RapportB2BRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Exception;

class RapportB2BService
{
    protected $rapportB2BRepository;
    protected $slackService;

    public function __construct(
        RapportB2BRepository $rapportB2BRepository,
        SlackService $slackService
    ) {
        $this->rapportB2BRepository = $rapportB2BRepository;
        $this->slackService = $slackService;
    }

    public function getAllRapportB2B()
    {
        try {
            $rapports = $this->rapportB2BRepository->all();

            // $this->slackService->sendNotification(
            //     "Rapport B2B list fetched successfully."
            // );

            return $rapports;

        } catch (Exception $e) {

            // $this->slackService->sendNotification(
            //     "Error fetching Rapport B2B list: " . $e->getMessage()
            // );

            throw $e;
        }
    }

    public function findRapportB2B($id)
    {
        try {
            $rapport = $this->rapportB2BRepository->find($id);

            // $this->slackService->sendNotification(
            //     "Rapport B2B fetched successfully. ID: {$id}"
            // );

            return $rapport;

        } catch (Exception $e) {

            // $this->slackService->sendNotification(
            //     "Error fetching Rapport B2B ID {$id}: " . $e->getMessage()
            // );

            throw $e;
        }
    }

    public function createRapportB2B(array $data, ?UploadedFile $sary = null)
    {
        try {

            if ($sary) {
                $data['sary'] = $sary->store('rapportB2B/files', 'public');
            }

            $rapport = $this->rapportB2BRepository->create($data);

            $recipientAddresses = array_filter(
                array_map(
                    'trim',
                    explode(',', config('mail.rapport_b2b.to.address', ''))
                )
            );

            $recipientName = config('mail.rapport_b2b.to.name');

            if (!empty($recipientAddresses)) {
                try {
                    logger()->info('Attempting to send Rapport B2B email', [
                        'recipients' => $recipientAddresses,
                        'rapport_id' => $rapport->id,
                        'mailer' => config('mail.default'),
                        'host' => config('mail.mailers.smtp.host'),
                        'port' => config('mail.mailers.smtp.port'),
                        'scheme' => config('mail.mailers.smtp.scheme'),
                        'username' => config('mail.mailers.smtp.username'),
                    ]);

                    Mail::to($recipientAddresses)
                        ->send(new RapportB2BCreatedMail($rapport));

                    logger()->info('Rapport B2B email sent successfully.', [
                        'rapport_id' => $rapport->id,
                        'recipients' => $recipientAddresses,
                    ]);

                } catch (Exception $mailException) {
                    logger()->warning('Failed to send Rapport B2B creation email.', [
                        'rapport_b2b_id' => $rapport->id,
                        'recipients' => $recipientAddresses,
                        'error' => $mailException->getMessage(),
                        'trace' => $mailException->getTraceAsString(),
                    ]);
                }
            }

            $this->slackService->sendNotification(
                "New Rapport B2B created successfully with ID: {$rapport->id}"
            );

            return $rapport;

        } catch (Exception $e) {

            $this->slackService->sendNotification(
                "Error creating Rapport B2B: " . $e->getMessage()
            );

            throw $e;
        }
    }

    public function getRapportB2BByIdVisite($id)
    {
        try {

            $rapport = $this->rapportB2BRepository->getRapportB2BByIdVisite($id);

            // $this->slackService->sendNotification(
            //     "Rapport B2B fetched by visite ID: {$id}"
            // );

            return $rapport;

        } catch (Exception $e) {

            // $this->slackService->sendNotification(
            //     "Error fetching Rapport B2B by visite ID {$id}: " . $e->getMessage()
            // );

            throw $e;
        }
    }
}
