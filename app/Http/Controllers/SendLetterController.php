<?php

namespace App\Http\Controllers;

use App\Mail\InvitationLetter;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class SendLetterController extends Controller
{
    public function sendInvitation(Request $request) {
        $email = $request->email;
        $invitationText = $request->invitationText;
        /** @var User $user */
        $user = Auth::user();
        $invitationToken = $user->getInvitationToken();
        $invitationUrl = route('invite.employer', $invitationToken);
        $mail = new InvitationLetter($invitationUrl, $invitationText, Auth::user()->getFullName());
        Mail::to($email)->send($mail);
        return true;
    }
}