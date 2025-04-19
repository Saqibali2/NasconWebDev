<?php

namespace App\Repositories\Models;

use App\Models\Course;
use App\Repositories\Contracts\CourseInterfaceRepository;
use App\Repositories\BaseRepository;

class CourseRepository extends BaseRepository implements CourseInterfaceRepository
{
    protected $model;

    public function __construct(Course $course)
    {
        $this->model = $course;
    }

    /**
     * Begin querying a model with eager loading.
     *
     * @param  array|string  $relations
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getAllWith($relations)
    {
        return Course::with($relations)->get();
    }

    /**
     * Fetch data from the course table for one course.
     *
     * @param  mixed $course_id
     * @return Course
     */
    public function getCourseInfo($course_id)
    {
        return Course::with("Terms")->findOrFail($course_id);
    }

    /**
     * Get all courses by title and id.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllByTitleAndId()
    {
        return $this->model::pluck('title', 'id');
    }

    /**
     * Create a new course.
     *
     * @param  array  $data
     * @return Course
     */
  // In the create method:
  public function create(array $data)
  {
      // Ensure that you are saving the correct fields, including the video file path
      return $this->model::create([
          'title' => $data['title'],
          'description' => $data['description'],
          'department_id' => $data['department_id'],
          'video' => isset($data['video']) ? $data['video'] : null, // Save the video path if provided
          'thumbnail' => isset($data['thumbnail']) ? $data['thumbnail'] : null // Save the thumbnail if provided
      ]);
  }
  


    /**
     * Update an existing course.
     *
     * @param  mixed  $request
     * @param  mixed  $id
     * @return bool
     */
   // In the update method:
public function update($request, $id)
{
    $course = $this->model::findOrFail($id);

  
    return $course->update([
        'title' => $request['title'],
        'description' => $request['description'],
 
        'department_id' => $request['department_id'],
        'video' => isset($request['video']) ? $request['video'] : null, // Default to null if 'video' is not provided
        'thumbnail' => isset($request['thumbnail']) ? $request['thumbnail'] : null // Default to null if 'thumbnail' is not provided
    ]);
}

}
