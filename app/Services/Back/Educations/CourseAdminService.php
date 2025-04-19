<?php

namespace App\Services\Back\Educations;

use App\Repositories\Contracts\CourseInterfaceRepository;
use App\Repositories\Contracts\DepartmentInterfaceRepository;
use App\Services\Back\Services;
use App\Services\Traits\CrudableService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class CourseAdminService extends Services
{
    use CrudableService;

    protected $path = 'contents.admin.courses';
    protected $route = 'course';

    protected $departmentRepository;

    public function __construct(
        CourseInterfaceRepository $courseRepository,
        DepartmentInterfaceRepository $departmentRepository
    ) {
        $this->repository = $courseRepository;
        $this->departmentRepository = $departmentRepository;
    }

    public function create()
    {
        return ['departments' => $this->departmentRepository->getAllByTitleAndId()];
    }

    public function edit($course_id)
    {
        return [
            'course' => $this->repository->findById($course_id),
            'departments' => $this->departmentRepository->getAllByTitleAndId()
        ];
    }

    /**
     * Store a new course with video and thumbnail.
     *
     * @param array $data
     * @return mixed
     */
    public function store(array $data)
    {
        // Handle thumbnail upload
        if (isset($data['thumbnail']) && $data['thumbnail'] instanceof UploadedFile) {
            $data['thumbnail'] = $data['thumbnail']->store('uploads/thumbnails', 'public');
        }
// Handle video upload
if (isset($data['video_file']) && $data['video_file'] instanceof UploadedFile) {
    $videoPath = $data['video_file']->store('uploads/videos', 'public');
    $data['video'] = encrypt($videoPath); // 🔐 Encrypt the path
}

        // Handle video upload
   

        // Save the course data, including the video and thumbnail paths
        return $this->repository->create($data);
    }

    /**
     * Update an existing course with new video and/or thumbnail.
     *
     * @param array $data
     * @param int $course_id
     * @return mixed
     */
    public function update(array $data, $course_id)
    {
        $course = $this->repository->findById($course_id);

        // Handle thumbnail update
        if (isset($data['thumbnail']) && $data['thumbnail'] instanceof UploadedFile) {
            // Delete old thumbnail if exists
            if ($course->thumbnail) {
                Storage::disk('public')->delete($course->thumbnail);
            }

            // Upload new thumbnail and get the path
            $thumbnailPath = $data['thumbnail']->store('uploads/thumbnails', 'public');
            $data['thumbnail'] = $thumbnailPath; // Save the new thumbnail path
        }

      
        if (isset($data['video_file']) && $data['video_file'] instanceof UploadedFile) {
            if ($course->video) {
                try {
                    $existingVideoPath = decrypt($course->video);
                    if (Storage::disk('public')->exists($existingVideoPath)) {
                        Storage::disk('public')->delete($existingVideoPath);
                    }
                } catch (\Exception $e) {
                    // Could not decrypt, skip deleting
                }
            }
        
            $videoPath = $data['video_file']->store('uploads/videos', 'public');
            $data['video'] = encrypt($videoPath); // 🔐 Encrypt the path
        }
        
        // Update the course data with the new video and/or thumbnail
        return $this->repository->update($data, $course_id);
    }
}
