<?php

namespace Tests\Feature;

use App\Models\Alunos;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AlunosControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testStore()
    {
        $response = $this->postJson('/api/aluno', [
            'nome' => 'Teste',
            'email' => 'teste@example.com',
            'dat_nascimento' => '1990-01-01',
        ]);

        $response->assertStatus(201);
    }

    public function testUpdate()
    {
        $aluno = Alunos::factory()->create();

        $response = $this->putJson("/api/aluno/{$aluno->id}", [
            'nome' => 'Novo Nome',
            'email' => 'novoemail@example.com',
            'dat_nascimento' => '1990-01-01',
        ]);

        $response->assertStatus(200);
    }

    public function testDelete()
    {
        $aluno = Alunos::factory()->create();

        $response = $this->deleteJson("/api/aluno/{$aluno->id}");

        $response->assertStatus(200);
    }
}
