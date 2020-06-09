<?php

namespace Tests\Feature;

use App\Projects;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ProjectsTest extends TestCase
{
    use DatabaseMigrations;

    public function test_can_create_project() {
        $project = [
            'name' => "Dev Project",
            'status' => "planned",
        ];

        $this->post(route('project.create'), $project)
            ->assertStatus(200)
            ->assertJson($project);
    }

    public function test_can_show_project() {

        $projects = factory(Projects::class)->create();

        $this->get(route('project.show', $projects->id))
            ->assertStatus(200);
    }

    public function test_can_edit_project() {

        $project = factory(Projects::class)->create();

        $data = [
            'name' => "Dev unit 1",
            'description' => "Dev description",
            'status' => "planned"
        ];

        $this->put(route('project.update', $project->id), $data)
            ->assertStatus(200);
    }

    public function test_can_delete_project() {

        $projects = factory(Projects::class)->create();

        $this->delete(route('project.destroy', $projects->id))
            ->assertStatus(200);
    }

    public function test_can_list_projects() {
        $projects = factory(Projects::class, 10)->create()->map(function ($projects) {
            return $projects->only(['id', 'name', 'status']);
        });

        $this->get(route('projects.list'))
            ->assertStatus(200);
    }
}
