<?php

namespace Tests\Unit;

use App\Goal;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GoalTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateGoal()
    {
        $response = $this->json('POST', route('v1.goal.create'), [
            'title' => 'Test',
            'body' => 'I am a test goal'
        ]);

        $response->assertStatus(201)
            ->assertHeader('Location')
            ->assertJson([
                'id' => 1
            ]);
    }

    public function testCreateGoalNoPostBody()
    {
        $response = $this->json('POST', route('v1.goal.create'), []);

        $response->assertStatus(422)
            ->assertHeaderMissing('Location')
            ->assertJson([
                'errors' => [
                    'title' => [
                        'The title field is required.'
                    ]
                ]
            ]);
    }

    public function testCreateGoalTitleOnly()
    {
        $response = $this->json('POST', route('v1.goal.create'), [
            'title' => 'Test',
        ]);

        $response->assertStatus(201)
            ->assertHeader('Location')
            ->assertJson([
                'id' => 1
            ]);
    }

    public function testCreateGoalSendIdInPostBody()
    {
        $response = $this->json('POST', route('v1.goal.create'), [
            'title' => 'Test',
            'id' => 1
        ]);

        $response->assertStatus(201)
            ->assertHeader('Location')
            ->assertJson([
                'id' => 1
            ]);
    }

    public function testUpdateGoal()
    {
        $this->json('POST', route('v1.goal.create'), [
            'title' => 'Test',
            'body' => 'I am a test goal'
        ]);

        $response = $this->json('PUT', route('v1.goal.update', ['id' => 1]), [
            'title' => 'Testing',
            'body' => 'I am an updated test goal'
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'id' => 1,
                'title' => 'Testing',
                'body' => 'I am an updated test goal'
            ]);
    }


    public function testDeleteGoal()
    {
        $this->json('POST', route('v1.goal.create'), [
            'title' => 'Test',
            'body' => 'I am a test goal'
        ]);

        $this->assertEquals(Goal::count(), 1);

        $response = $this->json('DELETE', route('v1.goal.delete', ['id' => 1]));

        $response->assertStatus(200)
            ->assertJson([
                'deleted' => true,
            ]);

        $this->assertEquals(Goal::count(), 0);
    }

    public function testGetGoal()
    {
        $this->json('POST', route('v1.goal.create'), [
            'title' => 'Test',
            'body' => 'I am a test goal'
        ]);

        $response = $this->json('GET', route('v1.goal.get', ['id' => 1]));

        $response->assertStatus(200)
            ->assertJson([
                'id' => 1,
                'title' => 'Test',
                'body' => 'I am a test goal'
            ]);
    }

    public function testGetNonExistentGoal()
    {
        $response = $this->json('GET', route('v1.goal.get', ['id' => 1]));

        $response->assertStatus(404);
    }

}
