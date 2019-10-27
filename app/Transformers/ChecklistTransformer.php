<?php
namespace App\Transformers;
use App\Models\Checklist;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class ChecklistTransformer extends TransformerAbstract
{
    public function transform(Checklist $checklist)
    {
        return [
              'type' => 'checklists',
              'id' => $checklist->id,
              'attributes' => [
                  'object_domain' => $checklist->object_domain,
                  'object_id' => $checklist->object_id,
                  'description' => $checklist->description,
                  'is_completed' => (boolean) $checklist->is_completed,
                  'due' => $checklist->due,
                  'urgency' => $checklist->urgency,
                  'completed_at' => $checklist->completed_at,
                  'last_update_by' => $checklist->last_update_by,
                  'updated_at' => Carbon::parse($checklist->created_at)->format('c'),
                  'created_at' => Carbon::parse($checklist->updated_at)->format('c'),
              ],
              'links' => [
                  'self' => url().'/checklist/'.$checklist->id
              ]
        ];
    }
}