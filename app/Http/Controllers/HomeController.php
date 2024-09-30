<?php

namespace App\Http\Controllers;

use App\Jobs\SendMessage;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use function Illuminate\Log\log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::where('id', auth()->id())->select([
            'id', 'name', 'email',
        ])->first();

        $users = User::select(['id', 'name', 'email'])->get();

        return view('home', [
            'user' => $user,
            'users' => $users,
        ]);
    }

    public function messages(): JsonResponse {
        $messages = Message::where('user_id', auth()->id())
                            ->orWhere('recipient_id', auth()->id())
                            ->with('user')
                            ->get()
                            ->append('time');
        return response()->json($messages);
    }

    public function message(Request $request): JsonResponse {
        try {
            $message = Message::create([
                'user_id' => auth()->id(),
                'recipient_id' => (int) $request->get('recipientId'),
                'text' => $request->get('text'),
            ]);

            SendMessage::dispatch($message);

            return response()->json([
                'success' => true,
                'message' => "Message created and job dispatched.",
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function edit()
    {
        $user = User::where('id', auth()->id())->first();

        return view('register', compact('user'));
    }

}
