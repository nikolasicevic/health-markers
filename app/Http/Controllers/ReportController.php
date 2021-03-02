<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ReportMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Interfaces\DayRepositoryInterface;

class ReportController extends Controller
{   
    private $dayRepo;

    public function __construct(DayRepositoryInterface $dayRepo)
    {
        $this->dayRepo = $dayRepo;
    }

    /**
     * Set report title.
     *
     * @param int $dayCount
     * @return string
     */
    public function setReportTitile($dayCount)
    {
        return 'Izveštaj za poslednjih ' . $dayCount . ' dana';
    }

    /**
     * Send mail.
     *
     * @param string $title
     * @param array $data
     * @return \Illuminate\Http\Response
     */
    public function sendReport($title, $data)
    {
        try{
            Mail::to(config('app.report_mail'))->send(new ReportMail($title, $data));

            return redirect()->route('index')
                             ->with('message', $title . ' poslat!')
                             ->with('status', 'success');
        } catch(\Exception $e){
            return redirect()->route('index')
                             ->with('error', $e->getMessage())
                             ->with('status', 'danger');
        }
    }

    /**
     * Send report for previous 30 days.
     *
     * @return \Illuminate\Http\Response
     */
    public function weekly()
    {
        $days = $this->dayRepo->lastDays(self::WEEK);
        $data = $this->dayRepo->setData($days, false);
        $title = $this->setReportTitile($data['day_count']);

        return $this->sendReport($title, $data);
    }

    /**
     * Send report for previous 30 days.
     *
     * @return \Illuminate\Http\Response
     */
    public function monthly()
    {
        $days = $this->dayRepo->lastDays(self::MONTH);
        $data = $this->dayRepo->setData($days, false);
        $title = $this->setReportTitile($data['day_count']);

        return $this->sendReport($title, $data);
    }

    /**
     * Send report for previous 90 days.
     *
     * @return \Illuminate\Http\Response
     */
    public function quarterly()
    {
        $days = $this->dayRepo->lastDays(self::QUARTER);
        $data = $this->dayRepo->setData($days, false);
        $title = $this->setReportTitile($data['day_count']);

        return $this->sendReport($title, $data);
    }
}
