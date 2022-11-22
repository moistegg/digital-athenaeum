<section class="mt-8 space-y-8 pb-5">
    <p class="text-2xl font-bold">Settings</p>

    <div class="space-y-4">
        <div class="flex items-center space-x-4">
            <p class="text-lg font-semibold">Subjects</p>

            <div>
                <?php $modal_trigger = new Component('modal.trigger', ['target' => 'modal-add-subject']) ?>
                    <button type="button" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </button>
                <?php $modal_trigger->close() ?>
    
                <?php $modal = new Component('modal', ['id' => 'modal-add-subject']) ?>
                    <div class="space-y-6">
                        <p class="text-2xl font-semibold">Add Subject</p>

                        <form method="post" class="space-y-5">
                            <div class="form">
                                <div class="form-input-group">
                                    <label class="label" for="subject_group">Subject Group</label>
                                    <select id="subject_group" name="subject_group" class="form-input primary p-3" required>
                                        <option value="" selected disabled>Choose Subject Group</option>
                                        <?php foreach (SubjectGroups() as $subject_id => $subject_name): ?>
                                            <option value="<?=$subject_id?>"><?=$subject_name?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                
                            <div class="form">
                                <div class="form-input-group">
                                    <label class="label" for="subject_name">Subject Name</label>
                                    <input type="text" id="subject_name" name="subject_name" class="form-input primary p-3" placeholder="Subject Name" required/>
                                </div>
                            </div>
                
                            <button type="submit" name="add_subject" class="btn btn-primary w-full py-3">Add Subject</button>
                        </form>
                    </div>
                <?php $modal->close() ?>
            </div>
        </div>

        <?php if (count($this->subjects) > 0): ?>
            <div class="w-full border rounded overflow-hidden text-sm">
                <table class="w-full">
                    <thead>
                        <tr class="border-b bg-zinc-100">
                            <th class="p-2 uppercase text-left">Group</th>
                            <th class="p-2 uppercase text-left">Subject</th>
                            <th class="p-2 w-32"></th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        <?php foreach ($this->subjects as $row): ?>
                            <tr>
                                <td class="p-2"><?=SubjectGroups()[$row->subject_group_id]?></td>
                                <td class="p-2"><?=$row->name?></td>
                                <td class="p-2 flex items-center justify-end space-x-2">
                                    <div>
                                        <?php $modal_trigger = new Component('modal.trigger', ['target' => 'modal-edit-subject'.$row->id]) ?>
                                            <button type="button" class="text-gray-500 hover:text-gray-800 transition-default">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                </svg>
                                            </button>
                                        <?php $modal_trigger->close() ?>
                            
                                        <?php $modal = new Component('modal', ['id' => 'modal-edit-subject'.$row->id]) ?>
                                            <div class="space-y-6">
                                                <p class="text-2xl font-semibold">Edit Subject</p>

                                                <form method="post" class="space-y-5">
                                                    <input type="hidden" name="id" value="<?=$row->id?>"/>

                                                    <div class="form">
                                                        <div class="form-input-group">
                                                            <label class="label" for="subject_group">Subject Group</label>
                                                            <select id="subject_group" name="subject_group" class="form-input primary p-3" required>
                                                                <option value="" selected disabled>Choose Subject Group</option>
                                                                <?php foreach (SubjectGroups() as $subject_id => $subject_name): ?>
                                                                    <option value="<?=$subject_id?>" <?=($row->subject_group_id == $subject_id) ? 'selected' : ''?>><?=$subject_name?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                        
                                                    <div class="form">
                                                        <div class="form-input-group">
                                                            <label class="label" for="subject_name">Subject Name</label>
                                                            <input type="text" id="subject_name" name="subject_name" class="form-input primary p-3" placeholder="Subject Name" value="<?=$row->name?>" required/>
                                                        </div>
                                                    </div>
                                        
                                                    <button type="submit" name="update_subject" class="btn btn-primary w-full py-3">Update Subject</button>
                                                </form>
                                            </div>
                                        <?php $modal->close() ?>
                                    </div>
                                    
                                    <div>
                                        <form method="post">
                                            <input type="hidden" name="id" value="<?=$row->id?>"/>
                                            <button type="submit" name="destroy_subject" class="text-gray-500 hover:text-gray-800 transition-default">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-gray-400 font-light text-sm tracking-wider">No subject available</p>
        <?php endif; ?>
    </div>
</section>