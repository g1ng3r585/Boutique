<?php

namespace App\Tests\Feature;;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


use App\Models\Produit;

use Tests\TestCase;
use App\Http\Requests\ProduitRequest;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;


class TestRequest extends TestCase
{
    use RefreshDatabase;
    use WithFaker, RefreshDatabase;

    /* ========== Admin ========== */
    public function testEmailValidationRuleAdminRequest()
    {
        $request = new AdminRequest();
        $rules = $request->rules();
        $this->assertEquals(
            $rules['email'],
            'required|email|min:10|max:50|regex:/^([a-zA-ZÀ-ÿ]-?)+(\.([a-zA-Z]-?)+)+\.([0-9]{2})@cegeptr.qc.ca$/|unique:admins,email,NULL,id|unique:usagers,email,NULL,id'
        );
    }
    public function testPasswordValidationRuleAdminRequest()
    {
        $request = new AdminRequest();
        $rules = $request->rules();
    
        $this->assertArrayHasKey('password', $rules);
        $this->assertIsString($rules['password']);
        $this->assertEquals('required|min:6|max:255', $rules['password']);
    }
    public function testLastnameValidationRuleAdminRequest()
    {
        $request = new AdminRequest();
        $rules = $request->rules();
    
        $this->assertArrayHasKey('lastname', $rules);
        $this->assertIsString($rules['lastname']);
        $this->assertEquals('required|min:3|max:50', $rules['lastname']);
    }
    public function testNameValidationRuleAdminRequest()
    {
        $request = new AdminRequest();
        $rules = $request->rules();
    
        $this->assertArrayHasKey('name', $rules);
        $this->assertIsString($rules['name']);
        $this->assertEquals('required|min:3|max:50', $rules['name']);
    }    
    public function testAdminRequestValidation()
    {
        $response = $this->post('/admin/register', [
            'email' => 'john.smith.01@cegeptr.qc.ca',
            'password' => 'password',
            'lastname' => 'Doe',
            'name' => 'John',
        ]);
    
        $response->assertSessionHasNoErrors();
    }
    /* ========== Produit ========== */
    public function testImageValidationRulesProduitRequest()
    {
        $request = new ProduitRequest();
    
        $rules = $request->rules();
    
        $this->assertArrayHasKey('image', $rules);
        $this->assertEquals('nullable|image|mimes:png,jpeg,jpg,gif,webp,JPG|max:1000000|min:4'
        , $rules['image']);
    }
    public function testTitreValidationRulesProduitRequest()
    {
        $request = new ProduitRequest();
        $rules = $request->rules();
        $this->assertEquals('required|string|min:3|max:50', $rules['titre']);
    }
    public function testPrixValidationRulesProduitRequest()
    {
        $request = new ProduitRequest();
        $rules = $request->rules();
        $this->assertEquals('required|numeric|min:0.01|max:1000000', $rules['prix']);
    }
    public function testCaracteristiquesValidationRulesProduitRequest()
    {
        $request = new ProduitRequest();
    
        $rules = $request->rules();
    
        $this->assertArrayHasKey('caracteristiques', $rules);
        $this->assertEquals('nullable|min:3|max:100', $rules['caracteristiques']);
    }
    public function testTitreMinValidationProduitRequest()
    {
        $data = ['titre' => 'aa'];
        $request = new ProduitRequest();
        $validator = Validator::make($data, $request->rules());
        $this->assertTrue($validator->fails());
    }
    public function testPrixNumericValidationProduitRequest()
    {
        $data = ['prix' => 'abc'];
        $request = new ProduitRequest();
        $validator = Validator::make($data, $request->rules());
        $this->assertTrue($validator->fails());
    }
    public function testCaracteristiquesMinValidationProduitRequest()
    {
        $data = ['caracteristiques' => 'aa'];
        $request = new ProduitRequest();
        $validator = Validator::make($data, $request->rules());
        $this->assertTrue($validator->fails());
    }
    public function testImageMaxValidationProduitRequest()
    {
        $data = ['image' => UploadedFile::fake()->image('test.jpg')->size(2000000)];
        $request = new ProduitRequest();
        $validator = Validator::make($data, $request->rules());
        $this->assertTrue($validator->fails());
    }
    public function testTitreMaxValidationProduitRequest()
    {
        $data = ['titre' => str_repeat('a', 51)];
        $request = new ProduitRequest();
        $validator = Validator::make($data, $request->rules());
        $this->assertTrue($validator->fails());
    }
    public function testPrixMinValidationProduitRequest()
    {
        $data = ['prix' => 0];
        $request = new ProduitRequest();
        $validator = Validator::make($data, $request->rules());
        $this->assertTrue($validator->fails());
    }
    public function testPrixMaxValidationProduitRequest()
    {
        $data = ['prix' => 11];
        $request = new ProduitRequest();
        $validator = Validator::make($data, $request->rules());
        $this->assertTrue($validator->fails());
    }
    public function testCaracteristiquesMaxValidationProduitRequest()
    {
        $data = ['caracteristiques' => str_repeat('a', 101)];
        $request = new ProduitRequest();
        $validator = Validator::make($data, $request->rules());
        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('caracteristiques', $validator->errors()->toArray());
    }
    public function testImageMinValidationMessageProduitRequest()
    {
        $request = new ProduitRequest();
    
        $messages = $request->messages();
    
        $this->assertIsArray($messages);
        $this->assertArrayHasKey('image.min', $messages);
        $this->assertIsString($messages['image.min']);
    }
    public function testImageMaxValidationMessageProduitRequest()
    {
        $request = new ProduitRequest();
    
        $messages = $request->messages();
    
        $this->assertIsArray($messages);
        $this->assertArrayHasKey('image.max', $messages);
        $this->assertIsString($messages['image.max']);
    }
    public function testTitreRequiredValidationMessageProduitRequest()
    {
        $request = new ProduitRequest();
    
        $messages = $request->messages();
    
        $this->assertIsArray($messages);
        $this->assertArrayHasKey('titre.required', $messages);
        $this->assertIsString($messages['titre.required']);
    }
    public function testTitreMinValidationMessageProduitRequest()
    {
        $request = new ProduitRequest();
    
        $messages = $request->messages();
    
        $this->assertIsArray($messages);
        $this->assertArrayHasKey('titre.min', $messages);
        $this->assertIsString($messages['titre.min']);
    }
    public function testTitreMaxValidationMessageProduitRequest()
    {
        $request = new ProduitRequest();
    
        $messages = $request->messages();
    
        $this->assertIsArray($messages);
        $this->assertArrayHasKey('titre.max', $messages);
        $this->assertIsString($messages['titre.max']);
    }
    public function testPrixRequiredValidationMessageProduitRequest()
    {
        $request = new ProduitRequest();
    
        $messages = $request->messages();
    
        $this->assertIsArray($messages);
        $this->assertArrayHasKey('prix.required', $messages);
        $this->assertIsString($messages['prix.required']);
    }
    public function testPrixNumericValidationMessageProduitRequest()
    {
        $request = new ProduitRequest();
    
        $messages = $request->messages();
    
        $this->assertIsArray($messages);
        $this->assertArrayHasKey('prix.numeric', $messages);
        $this->assertIsString($messages['prix.numeric']);
    }
    public function testPrixMinValidationMessageProduitRequest()
    {
        $request = new ProduitRequest();
    
        $messages = $request->messages();
    
        $this->assertIsArray($messages);
        $this->assertArrayHasKey('prix.min', $messages);
        $this->assertIsString($messages['prix.min']);
    }
    public function testPrixMaxValidationMessageProduitRequest()
    {
        $request = new ProduitRequest();
    
        $messages = $request->messages();
    
        $this->assertIsArray($messages);
        $this->assertArrayHasKey('prix.max', $messages);
        $this->assertIsString($messages['prix.max']);
    }
    public function testCaracteristiquesMinValidationMessageProduitRequest()
    {
        $request = new ProduitRequest();
    
        $messages = $request->messages();
    
        $this->assertIsArray($messages);
        $this->assertArrayHasKey('caracteristiques.min', $messages);
        $this->assertIsString($messages['caracteristiques.min']);
    }
    public function testCaracteristiquesMaxValidationMessageProduitRequest()
    {
        $request = new ProduitRequest();
    
        $messages = $request->messages();

        $this->assertIsArray($messages);
        $this->assertArrayHasKey('caracteristiques.max', $messages);
        $this->assertIsString($messages['caracteristiques.max']);
    }
    /* ========== Client ========== */
    public function testImageMinValidationProduitRequest()
    {
        $data = ['image' => UploadedFile::fake()->image('test.jpg')->size(3)];
        $request = new ProduitRequest();
        $validator = Validator::make($data, $request->rules());
        $this->assertTrue($validator->fails());
        $this->assertContains('validation.min.file', $validator->errors()->all());
    }    
    public function testValidationRulesClientRequestHasPassword()
    {
        $request = new ClientRequest();
    
        $rules = $request->rules();
    
        $this->assertArrayHasKey('password', $rules);
        $this->assertEquals('required|min:6|max:255', $rules['password']);
    }    
    public function testValidationRulesClientRequestHasLastName()
    {
        $request = new ClientRequest();
    
        $rules = $request->rules();
    
        $this->assertArrayHasKey('lastName', $rules);
        $this->assertEquals('required|min:3|max:50', $rules['lastName']);
    }    
    public function testValidationRulesClientRequestHasName()
    {
        $request = new ClientRequest();
    
        $rules = $request->rules();
    
        $this->assertArrayHasKey('name', $rules);
        $this->assertEquals('required|min:3|max:50', $rules['name']);
    }
    public function testClientRequestValidationSuccess(): void
    {
        $data = [
            'email' => 'johnsmith@domain.com',
            'password' => '123456',
            'lastName' => 'Doe',
            'name' => 'John',
        ];
    
        // Test de validation réussie
        $response = $this->post(route('clients.store'), $data);
        $response->assertSessionHasNoErrors();
    }    
    public function testClientRequestValidationEmailMissing(): void
    {
        $data = [
            'email' => '',
            'password' => '123456',
            'lastName' => 'Doe',
            'name' => 'John',
        ];
    
        // Test de validation échouée pour le champ email manquant
        $response = $this->post(route('clients.store'), $data);
        $response->assertSessionHasErrors(['email']);
    }    
    public function testClientRequestValidationEmailTooShort(): void
    {
        $data = [
            'email' => 'johnsmith',
            'password' => '123456',
            'lastName' => 'Doe',
            'name' => 'John',
        ];
    
        // Test de validation échouée pour le champ email trop court
        $response = $this->post(route('clients.store'), $data);
        $response->assertSessionHasErrors(['email']);
    }    
    public function testClientRequestValidationPasswordMissing(): void
    {
        $data = [
            'email' => 'johnsmith@domain.com',
            'password' => '',
            'lastName' => 'Doe',
            'name' => 'John',
        ];
    
        // Test de validation échouée pour le champ password manquant
        $response = $this->post(route('clients.store'), $data);
        $response->assertSessionHasErrors(['password']);
    }    
    public function testClientRequestValidationPasswordTooShort(): void
    {
        $data = [
            'email' => 'johnsmith@domain.com',
            'password' => '12345',
            'lastName' => 'Smith',
            'name' => 'John',
        ];
    
        // Test de validation échouée pour le champ password trop court
        $response = $this->post(route('clients.store'), $data);
        $response->assertSessionHasErrors(['password']);
    }    
    public function testClientRequestValidationPasswordTooLong(): void
    {
        $data = [
            'email' => 'johnsmith@domain.com',
            'password' => str_repeat('a', 256),
            'lastName' => 'Smith',
            'name' => 'John',
        ];
    
        // Test de validation échouée pour le champ password trop long
        $response = $this->post(route('clients.store'), $data);
        $response->assertSessionHasErrors(['password']);
    }    
    public function testClientRequestValidationLastNameMissing(): void
    {
        $data = [
            'email' => 'johnsmith@domain.com',
            'password' => '123456',
            'lastName' => '',
            'name' => 'John',
        ];

        $response = $this->post(route('clients.store'), $data);
        $response->assertSessionHasErrors(['lastName']);
        $response->assertSessionDoesntHaveErrors(['email', 'password', 'name']);
    }    
    public function testClientRequestValidationLastNameTooShort(): void
    {
        $data = [
            'email' => 'johnsmith@domain.com',
            'password' => '123456',
            'lastName' => 'D',
            'name' => 'John',
        ];

        $response = $this->post(route('clients.store'), $data);
        $response->assertSessionHasErrors(['lastName']);
        $response->assertSessionDoesntHaveErrors(['email', 'password', 'name']);
    }
    public function testClientRequestValidationLastNameTooLong(): void
    {
        $data = [
            'email' => 'johnsmith@domain.com',
            'password' => '123456',
            'lastName' => str_repeat('a', 51),
            'name' => 'John',
        ];

        $response = $this->post(route('clients.store'), $data);
        $response->assertSessionHasErrors(['lastName']);
        $response->assertSessionDoesntHaveErrors(['email', 'password', 'name']);
    }
    public function testClientRequestValidationNameMissing(): void
    {
        $data = [
            'email' => 'johnsmith@domain.com',
            'password' => '123456',
            'lastName' => 'Smith',
            'name' => '',
        ];

        $response = $this->post(route('clients.store'), $data);
        $response->assertSessionHasErrors(['name']);
        $response->assertSessionDoesntHaveErrors(['email', 'password', 'lastName']);
    }
    public function testClientRequestValidationNameTooShort(): void
    {
        $data = [
            'email' => 'johnsmith@domain.com',
            'password' => '123456',
            'lastName' => 'Smith',
            'name' => 'J',
        ];

        $response = $this->post(route('clients.store'), $data);
        $response->assertSessionHasErrors(['name']);
        $response->assertSessionDoesntHaveErrors(['email', 'password', 'lastName']);
    }
    public function testClientRequestValidationNameTooLong(): void
    {
        $data = [
            'email' => 'johnsmith@domain.com',
            'password' => '123456',
            'lastName' => 'Smith',
            'name' => str_repeat('a', 51),
        ];

        $response = $this->post(route('clients.store'), $data);
        $response->assertSessionHasErrors(['name']);
        $response->assertSessionDoesntHaveErrors(['email', 'password', 'lastName']);
    }
    public function testValidationMessagesClientRequest(): void
    {
        $request = new ClientRequest();

        $messages = $request->messages();

        $expectedKeys = [
            'email.required',
            'email.min',
            'email.max',
            'password.required',
            'password.min',
            'password.max',
            'lastName.required',
            'lastName.min',
            'lastName.max',
            'name.required',
            'name.min',
            'name.max',
        ];

        foreach ($expectedKeys as $key) {
            $this->assertArrayHasKey($key, $messages);
            $this->assertIsString($messages[$key]);
        }
    }
}
