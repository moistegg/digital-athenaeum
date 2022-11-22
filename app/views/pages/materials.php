<section class="mt-8 space-y-8 pb-5">
    <div class="flex items-center space-x-4">
        <p class="text-2xl font-bold"><?=$this->page_title?></p>

        <?php if (auth()->role == 1): ?>
            <div>
                <?php $modal_trigger = new Component('modal.trigger', ['target' => 'modal-add-material']) ?>
                    <button type="button" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </button>
                <?php $modal_trigger->close() ?>

                <?php $modal = new Component('modal', ['id' => 'modal-add-material']) ?>
                    <div class="space-y-4">
                        <p class="text-2xl font-semibold">Add Material</p>

                        <form method="post" class="space-y-5" enctype="multipart/form-data">
                            <div class="form">
                                <div class="form-input-group">
                                    <label class="label" for="section">Journal / Online Books / Articles</label>
                                    <select id="section" name="section" class="form-input primary p-3" required>
                                        <option value="" selected disabled>Choose Journal / Online Books / Articles</option>
                                        <?php foreach (Section() as $section_id => $section_name): ?>
                                            <option value="<?=$section_id?>"><?=$section_name?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form">
                                <div class="form-input-group">
                                    <label class="label" for="subject">Subject</label>
                                    <select id="subject" name="subject" class="form-input primary p-3" required>
                                        <option value="" selected disabled>Choose Subject</option>
                                        <?php foreach ($this->subjects as $subject): ?>
                                            <option value="<?=$subject->id?>"><?=$subject->name?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                
                            <div class="form">
                                <div class="form-input-group">
                                    <label class="label" for="title">Title</label>
                                    <input type="text" id="title" name="title" class="form-input primary p-3" required/>
                                </div>
                            </div>
                
                            <div class="form">
                                <div class="form-input-group">
                                    <label class="label" for="volume">Volume Information</label>
                                    <input type="text" id="volume" name="volume" class="form-input primary p-3" required/>
                                </div>
                            </div>
                
                            <div class="form">
                                <div class="form-input-group">
                                    <label class="label" for="about">About</label>
                                    <textarea id="about" name="about" class="form-input primary p-3 h-32" placeholder="Maximum 200 characters" maxlength="200" required></textarea>
                                </div>
                            </div>
                
                            <div class="form">
                                <div class="form-input-group">
                                    <label class="label" for="thumbnail">Material Thumbnail</label>
                                    <input type="file" id="thumbnail" name="thumbnail" class="form-input primary p-3" accept="image/*" required/>
                                </div>
                            </div>
                
                            <div class="form">
                                <div class="form-input-group">
                                    <label class="label" for="material">Material File (PDF)</label>
                                    <input type="file" id="material" name="material" class="form-input primary p-3" accept="application/pdf" required/>
                                </div>
                            </div>
                
                            <button type="submit" name="add_material" class="btn btn-primary w-full py-3">Add Material</button>
                        </form>
                    </div>
                <?php $modal->close() ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="divide-y">
        <?php if (count($this->materials) > 0): ?>
            <?php foreach ($this->materials as $row): ?>
                <div class="w-full flex space-x-12 py-6">
                    <div class="w-64 h-80 flex-none">
                        <img src="<?=storage("thumbnails/$row->thumbnail")?>" class="w-full h-full rounded"/>
                    </div>

                    <div class="w-full flex">
                        <div class="w-full flex flex-col justify-between items-start">
                            <div class="flex flex-col space-y-6">
                                <p class="text-2xl font-semibold"><?=$row->title?></p>
                                <p><?=$row->volume?></p>
                                <p class="text-sm font-light"><?=$row->about?></p>
                            </div>

                            <a href="<?=route("material?view=$row->id")?>" class="btn btn-primary py-3 px-6 flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>    
                                <p>Read</p>
                            </a>
                        </div>

                        <?php if (auth()->role == 1): ?>
                            <div class="w-20 flex-none flex space-x-2 justify-end">
                                <div>
                                    <?php $modal_trigger = new Component('modal.trigger', ['target' => 'modal-edit-material'.$row->id]) ?>
                                        <button type="button" class="text-gray-500 hover:text-gray-800 transition-default">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                        </button>
                                    <?php $modal_trigger->close() ?>

                                    <?php $modal = new Component('modal', ['id' => 'modal-edit-material'.$row->id]) ?>
                                        <div class="space-y-4">
                                            <p class="text-2xl font-semibold">Edit Material</p>

                                            <div class="space-y-8">
                                                <form method="post" class="space-y-5">
                                                    <input type="hidden" name="id" value="<?=$row->id?>"/>
                                                    <div class="form">
                                                        <div class="form-input-group">
                                                            <label class="label" for="section">Journal / Online Books / Articles</label>
                                                            <select id="section" name="section" class="form-input primary p-3" required>
                                                                <option value="" selected disabled>Choose Journal / Online Books / Articles</option>
                                                                <?php foreach (Section() as $section_id => $section_name): ?>
                                                                    <option value="<?=$section_id?>" <?=($section_id == $row->section_id) ? 'selected' : ''?>><?=$section_name?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form">
                                                        <div class="form-input-group">
                                                            <label class="label" for="subject">Subject</label>
                                                            <select id="subject" name="subject" class="form-input primary p-3" required>
                                                                <option value="" selected disabled>Choose Subject</option>
                                                                <?php foreach ($this->subjects as $subject): ?>
                                                                    <option value="<?=$subject->id?>" <?=($subject->id == $row->subject_id) ? 'selected' : ''?>><?=$subject->name?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                        
                                                    <div class="form">
                                                        <div class="form-input-group">
                                                            <label class="label" for="title">Title</label>
                                                            <input type="text" id="title" name="title" class="form-input primary p-3" value="<?=$row->title?>" required/>
                                                        </div>
                                                    </div>
                                        
                                                    <div class="form">
                                                        <div class="form-input-group">
                                                            <label class="label" for="volume">Volume Information</label>
                                                            <input type="text" id="volume" name="volume" class="form-input primary p-3" value="<?=$row->volume?>" required/>
                                                        </div>
                                                    </div>
                                        
                                                    <div class="form">
                                                        <div class="form-input-group">
                                                            <label class="label" for="about">About</label>
                                                            <textarea id="about" name="about" class="form-input primary p-3 h-32" placeholder="Maximum 200 characters" maxlength="200" required><?=$row->about?></textarea>
                                                        </div>
                                                    </div>

                                                    <button type="submit" name="update_material_info" class="btn btn-primary w-full py-3">Update Material Information</button>
                                                </form>

                                                <form method="post" class="space-y-5" enctype="multipart/form-data">
                                                    <input type="hidden" name="id" value="<?=$row->id?>"/>
                                                    <div class="form">
                                                        <div class="form-input-group">
                                                            <label class="label" for="thumbnail">Material Thumbnail</label>
                                                            <input type="file" id="thumbnail" name="thumbnail" class="form-input primary p-3" accept="image/*" required/>
                                                        </div>
                                                    </div>
                                        
                                                    <button type="submit" name="update_material_thumbnail" class="btn btn-primary w-full py-3">Update Material Thumbnail</button>
                                                </form>

                                                <form method="post" class="space-y-5" enctype="multipart/form-data">
                                                    <input type="hidden" name="id" value="<?=$row->id?>"/>
                                                    <div class="form">
                                                        <div class="form-input-group">
                                                            <label class="label" for="material">Material File (PDF)</label>
                                                            <input type="file" id="material" name="material" class="form-input primary p-3" accept="application/pdf" required/>
                                                        </div>
                                                    </div>
                                        
                                                    <button type="submit" name="update_material_file" class="btn btn-primary w-full py-3">Update Material File</button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php $modal->close() ?>
                                </div>

                                <div>
                                    <form method="post">
                                        <input type="hidden" name="id" value="<?=$row->id?>"/>
                                        <button type="submit" name="destroy_material" class="text-gray-500 hover:text-gray-800 transition-default">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-gray-400 font-light text-sm tracking-wider">No materials available</p>
        <?php endif; ?>
    </div>
</section>