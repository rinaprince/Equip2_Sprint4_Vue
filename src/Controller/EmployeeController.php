<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Entity\Login;
use App\Form\EmployeeType;
use App\Repository\EmployeeRepository;
use Doctrine\ORM\EntityManagerInterface;
/* docker-compose exec web-server composer require knplabs/knp-paginator-bundle*/

use Faker\Factory;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/employees')]
class EmployeeController extends AbstractController
{

    #[Route('', name: 'app_employee_index', methods: ['GET'])]
    #[IsGranted('ROLE_ADMINISTRATIVE')]
    public function index(EmployeeRepository $employeeRepository,PaginatorInterface $paginator, Request $request): Response
    {
            $q = $request->query->get('e','');


            if (empty($q))
                $employees = $employeeRepository->findAllQuery();
            else
                $employees = $employeeRepository->findByTextQuery($q);

            $pagination = $paginator->paginate(
                $employees,
                $request->query->getInt('page',1),7
            );

            return $this->render('employee/index.html.twig', [
                'pagination' => $pagination,
                'employees' => $pagination->getItems(),
                'e' => $q
        ]);
    }
    #[Route('/new', name: 'app_employee_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $employee = new Employee();
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($form->getViewData());
            dump($employee);
            if ($employee->getType() == 'administrative') {
                $login = $employee->getLogin();
                $passwd = $login->getPassword();
                $login->setPassword($this->hasher->hashPassword($login,$passwd ));
                $login->setRole('ROLE_ADMINISTRATIVE');
            }
            else if ($employee->getType()== 'administrator') {
                $login = $employee->getLogin();
                $passwd = $login->getPassword();
                $login->setPassword($this->hasher->hashPassword($login,$passwd ));
                $login->setRole('ROLE_ADMIN');
                $employee->setLogin($login);
            }
            $entityManager->persist($employee);
            $entityManager->flush();

            return $this->redirectToRoute('app_employee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('employee/new.html.twig', [
            'employee' => $employee,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_employee_show', methods: ['GET'])]
    #[IsGranted('ROLE_ADMINISTRATIVE')]
    public function show(Employee $employee): Response
    {
        return $this->render('employee/show.html.twig', [
            'employee' => $employee,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_employee_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(Request $request, Employee $employee, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_employee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('employee/edit.html.twig', [
            'employee' => $employee,
            'form' => $form,
        ]);
    }


    #[Route('/{id}/delete', name: 'app_employee_delete', methods: ['POST'])]
    public function delete(Request $request, Employee $employee, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$employee->getId(), $request->request->get('_token'))) {
            $entityManager->remove($employee);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_employee_index', [], Response::HTTP_SEE_OTHER);
    }
}
