<?php
namespace App\Transformers;
use App\Models\Checklist;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class ChecklistCreateTransformer extends TransformerAbstract
{
    public function transform(Checklist $checklist)
    {
        return [
              'type' => 'checklists',
              'id' => $checklist->id,
              'attributes' => [
                  'object_domain' => $checklist->object_domain,
                  'object_id' => $checklist->object_id,
                  'task_id' => $checklist->object_id,
                  'description' => $checklist->description,
                  'is_completed' => (boolean) $checklist->is_completed,
                  'due' => $checklist->due,
                  'urgency' => $checklist->urgency,
                  'completed_at' => $checklist->completed_at,
                  'created_by' => $checklist->created_by,
                  'updated_by' => $checklist->last_update_by,
                  'created_at' => Carbon::parse($checklist->created_at)->format('c'),
                  'updated_at' => Carbon::parse($checklist->updated_at)->format('c')
              ],
              'links' => [
                  'self' => url().'/checklist/'.$checklist->id
              ]
        ];
    }
}