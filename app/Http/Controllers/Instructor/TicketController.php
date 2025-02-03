<?php

namespace App\Http\Controllers\Instructor;

use App\Traits\SupportTicketManager;
use App\Http\Controllers\Controller;
class TicketController extends Controller
{
    use SupportTicketManager;

    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
        $this->layout = 'frontend';

        $this->middleware(function ($request, $next) {
            $this->user = auth('instructor')->user();
            if ($this->user) {
                $this->layout = 'master';
            }
            return $next($request);
        });

        $this->redirectLink = 'instructor.ticket.view';
        $this->userType     = 'instructor';
        $this->column       = 'instructor_id';
    }
}
