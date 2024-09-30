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
     * Crée une nouvelle instance de contrôleur.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Affiche l'écran d'accueil.
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

    /**
     * Renvoie les messages de l'utilisateur connecté.
     * Les messages sont triés par ordre de date de création.
     * @return \Illuminate\Http\JsonResponse
     */
    public function messages(): JsonResponse
    {
        $messages = Message::where('user_id', auth()->id())
                            ->orWhere('recipient_id', auth()->id())
                            ->with('user')
                            ->get()
                            ->append('time');

        return response()->json($messages);
    }

    /**
     * Crée un nouveau message.
     * Le message est stocké en base de données et un job est créé pour l'envoyer.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function message(Request $request): JsonResponse
    {
        try {
            $message = Message::create([
                'user_id' => auth()->id(),
                'recipient_id' => (int) $request->get('recipientId'),
                'text' => $request->get('text'),
            ]);

            SendMessage::dispatch($message);

            return response()->json([
                'success' => true,
                'message' => "Message sent and dispatched!",
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
