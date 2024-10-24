<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationFormTest extends WebTestCase {
    public function testFormSubmission() {
        $client = static::createClient();
        
        $crawler = $client->request('GET', '/');
        $this->assertResponseIsSuccessful();

        $form = $crawler->selectButton("S'inscrire")->form([
            'registration[Name]' => 'Stark',
            'registration[Surname]' => 'Tony',
            'registration[email]' => 'tony.stark@avengers.com',
        ]);

        $client->submit($form);

        $this->assertResponseRedirects();
        $client->followRedirect();
        $this->assertSelectorTextContains('.alert-success', 'Votre inscription a bien été prise en compte !');
    }

    public function testFormSubmissionWithExistingEmail() {
        $client = static::createClient();
        
        $crawler = $client->request('GET', '/');
        $this->assertResponseIsSuccessful();

        $form = $crawler->selectButton("S'inscrire")->form([
            'registration[Name]' => 'Stark',
            'registration[Surname]' => 'Tony',
            'registration[email]' => 'tony.stark@avengers.com',
        ]);

        $client->submit($form);

        $this->assertSelectorTextContains('.alert-error', 'Cet email est déjà utilisé pour une inscription.');
    }
}