<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\FilterTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Note;
use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;

class TaskController extends Controller
{
    public function index(FilterTaskRequest $request): AnonymousResourceCollection
    {
        $data = $request->validated();

        $filters = Arr::only($data, ['priority', 'status']);

        if ($data['due_date'] ?? false) {
            $filters['end_date'] = $data['due_date'];
        }

        $tasks = Task::orderByPriority()->with('notes');

        if (count($filters) > 0) {
            $tasks->where($filters);
        }

        if ($request->has('has_notes')) {
            $tasks->whereHas('notes');
        }

        if ($data['notes'] ?? false) {
            $tasks->whereHas('notes', function(Builder $query) use ($data) {
                $query->where('note', 'like', "%{$data['notes']}%");
            });
        }

        return TaskResource::collection($tasks->cursorPaginate());
    }


    public function create(CreateTaskRequest $request): TaskResource
    {
        $data = $request->validated();

        // create task
        /** @var Task $task */
        $task = Task::create($data);

        // upload notes images
        $notes = [];

        foreach ($request->validated('notes') as $index => $note) {
            $attachments = collect($request->file("notes.{$index}.attachments"))->map(fn(UploadedFile $attachment) => $attachment->store('attachments'));
            $note['attachments'] = $attachments;
            $notes[] = new Note($note);
        }

        $task->notes()->saveMany($notes);

        return new TaskResource($task->loadMissing('notes'));
    }
}
