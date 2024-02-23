<?php
//app/Http/Controllers/TrafficLogController.php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Models\TrafficLog;

class TrafficLogController extends Controller
{
    /**
     * Отображает главную страницу с логами движения.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $logs = TrafficLog::latest()->get();
        return view('traffic_light', compact('logs'));
    }

    /**
     * Обрабатывает действие пользователя, логирует его и возвращает сообщение.
     *
     * @param Request $request
     * @return string
     */
    public function logTraffic(Request $request): string
    {
        $action = $request->input('action');
        $previousAction = $request->input('previousAction');
        $message = $this->determineMessage($action, $previousAction);

        TrafficLog::create(['message' => $message]);;
        return $message;
    }
    /**
     * Определяет сообщение лога на основе текущего и предыдущего действий.
     *
     * @param string $action
     * @param string $previousAction
     * @return string
     */
    protected function determineMessage(string $action, string $previousAction): string
    {
        return match ($action) {
            'green' => "Проезд на зеленый!",
            'yellow' => $previousAction === 'green' ? "Успели на желтый!" : "Слишком рано начали движение!",
            'red' => "Проезд на красный. Штраф!",
            default => "Неизвестное действие",
        };
    }
}
