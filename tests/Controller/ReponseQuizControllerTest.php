<?php

namespace App\Test\Controller;

use App\Entity\ReponseQuiz;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReponseQuizControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/reponse/q/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(ReponseQuiz::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('ReponseQuiz index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'reponse_quiz[option1]' => 'Testing',
            'reponse_quiz[option2]' => 'Testing',
            'reponse_quiz[option3]' => 'Testing',
            'reponse_quiz[option4]' => 'Testing',
            'reponse_quiz[reponseCorrecte]' => 'Testing',
            'reponse_quiz[idQuest]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new ReponseQuiz();
        $fixture->setOption1('My Title');
        $fixture->setOption2('My Title');
        $fixture->setOption3('My Title');
        $fixture->setOption4('My Title');
        $fixture->setReponseCorrecte('My Title');
        $fixture->setIdQuest('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('ReponseQuiz');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new ReponseQuiz();
        $fixture->setOption1('Value');
        $fixture->setOption2('Value');
        $fixture->setOption3('Value');
        $fixture->setOption4('Value');
        $fixture->setReponseCorrecte('Value');
        $fixture->setIdQuest('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'reponse_quiz[option1]' => 'Something New',
            'reponse_quiz[option2]' => 'Something New',
            'reponse_quiz[option3]' => 'Something New',
            'reponse_quiz[option4]' => 'Something New',
            'reponse_quiz[reponseCorrecte]' => 'Something New',
            'reponse_quiz[idQuest]' => 'Something New',
        ]);

        self::assertResponseRedirects('/reponse/q/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getOption1());
        self::assertSame('Something New', $fixture[0]->getOption2());
        self::assertSame('Something New', $fixture[0]->getOption3());
        self::assertSame('Something New', $fixture[0]->getOption4());
        self::assertSame('Something New', $fixture[0]->getReponseCorrecte());
        self::assertSame('Something New', $fixture[0]->getIdQuest());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new ReponseQuiz();
        $fixture->setOption1('Value');
        $fixture->setOption2('Value');
        $fixture->setOption3('Value');
        $fixture->setOption4('Value');
        $fixture->setReponseCorrecte('Value');
        $fixture->setIdQuest('Value');

        $$this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/reponse/q/');
        self::assertSame(0, $this->repository->count([]));
    }
}
