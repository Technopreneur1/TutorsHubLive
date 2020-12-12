<?php


namespace App\Http\Controllers;


use App\Http\service\MeetingService;
use App\OnlineClass;
use App\Session;
use BigBlueButton\BigBlueButton;
use BigBlueButton\Parameters\CreateMeetingParameters;
use BigBlueButton\Parameters\GetRecordingsParameters;
use BigBlueButton\Parameters\IsMeetingRunningParameters;
use BigBlueButton\Parameters\JoinMeetingParameters;
use Illuminate\Support\Facades\Auth;
use mysql_xdevapi\Exception;

class MeetingController extends Controller
{
    public $attendee_password = 'jack1234';
    public $moderator_password = '1234jack';
    /**
     * MeetingController constructor.
     */
    public function __construct()
    {
        putenv('BBB_SECRET=XqXEiSwdVO0tAK47PSsTGasAbgC6rblWWeVJThZZuC0' );
        putenv('BBB_SERVER_BASE_URL=https://live.tutors-hub.com/bigbluebutton/');
    }

    public function startMeeting($id)
    {
        $session=Session::find($id);
        $this->createOnlineClass($session);
        return redirect()->away($this->joinClass($session));

    }
    public function createOnlineClass($session)
    {

        $meetingID = $session->id;

        $duration = $session->hours * 60;
        $urlLogout = route('home');
        $isRecordingTrue = true;
        $bbb = new BigBlueButton();

        $createMeetingParams = new CreateMeetingParameters($meetingID, $session->subject);
        $createMeetingParams->setAttendeePassword($this->attendee_password);
        $createMeetingParams->setModeratorPassword($this->moderator_password);
        $createMeetingParams->setDuration($duration);
//        $createMeetingParams->setDuration($duration);
        $createMeetingParams->setLogoutUrl($urlLogout);
        if ($isRecordingTrue) {
            $createMeetingParams->setRecord(true);
            $createMeetingParams->setAllowStartStopRecording(true);
            $createMeetingParams->setAutoStartRecording(false);
        }
//dd($createMeetingParams);
        $response = $bbb->createMeeting($createMeetingParams);
//        dd($response);
        if ($response->getReturnCode() == 'FAILED') {
            return false;
        } else {
            return true;
        }
    }
    public function checkOnlineClass($batch)
    {
        if ($batch->meeting_link) {
            return true;
        }
        try {


            $meetingID = $this->generateMeetingId($batch->code);

            $moderator_password = '1234jack';

            $bbb = new BigBlueButton();
//dd($meetingID);

//        $getMeetingInfoParams = new GetMeetingInfoParameters($meetingID,  $moderator_password);
            $meetrunningparams = new IsMeetingRunningParameters($meetingID);
//        dd($meetrunningparams);
//        dd($getMeetingInfoParams);
//        $response = $bbb->getMeetingInfo($getMeetingInfoParams);
            $response = $bbb->isMeetingRunning($meetrunningparams);
//        dd($meetingID);
            return $response->isRunning();
        } catch (Exception $e) {
            return false;
        }
    }

    public function joinClass($session,$name=null)
    {
        $name = auth()->user()->name;
        $meetingID = $session->id;


        $bbb = new BigBlueButton();
        $password = '';
        if (auth()->user()->type == 'teacher') {
            $password = $this->moderator_password;
        }else{
            $password = $this->attendee_password;

        }
        $joinMeetingParams = new JoinMeetingParameters($meetingID, auth()->user()->name, $password);


        $joinMeetingParams->setRedirect(true);
        $joinMeetingParams->setRedirect(true);
        $url = $bbb->getJoinMeetingURL($joinMeetingParams);

        return $url;
    }

    public  function getRecordings($id)
    {

        $recordingParams = new GetRecordingsParameters();
        $recordingParams->setMeetingId($id);
        $bbb = new BigBlueButton();
        $response = $bbb->getRecordings($recordingParams);
//        echo $id;die();

        if ($response->getReturnCode() == 'SUCCESS') {
//                echo json_encode($response->getRawXml()->recordings);die();
            foreach ($response->getRawXml()->recordings->recording as $recording) {
                header( "Content-type: application/json" );
                return json_encode(array('url' => $recording->playback->format->url, 'id' => $id, 'result' => true, 'record_id' => $recording->recordID));
//                if ($recording->metadata->meetingId == $meeting->id) {
//                    header( "Content-type: application/json" );
//                    return json_encode(array('url' => $recording->playback->format->url, 'id' => $meeting->id,'result'=>true,'record_id'=>$recording->recordID) );
//                } ;
            }
            return json_encode(array('result'=>false,'id' => $id)) ;

        }
        return json_encode(array('result'=>false,'id' => $id)) ;

    }

}
