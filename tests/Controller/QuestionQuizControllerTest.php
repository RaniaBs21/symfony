<?php

namespace App\Test\Controller;

use App\Entity\QuestionQuiz;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class QuestionQuizControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/question/q/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(QuestionQuiz::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('QuestionQuiz index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'question_quiz[descQuestion]' => 'Testing',
            'question_quiz[idQuiz]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new QuestionQuiz();
        $fixture->setDescQuestion('My Title');
        $fixture->setIdQuiz('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('QuestionQuiz');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new QuestionQuiz();
        $fixture->setDescQuestion('Value');
        $fixture->setIdQuiz('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'question_quiz[descQuestion]' => 'Something New',
            'question_quiz[idQuiz]' => 'Something New',
        ]);

        self::assertResponseRedirects('/question/q/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getDescQuestion());
        self::assertSame('Something New', $fixture[0]->getIdQuiz());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new QuestionQuiz();
        $fixture->setDescQuestion('Value');
        $fixture->setIdQuiz('Value');

        $$this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/question/q/');
        self::assertSame(0, $this->repository->count([]));
    }
}
