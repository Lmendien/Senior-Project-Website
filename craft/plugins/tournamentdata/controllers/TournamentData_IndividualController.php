<?php
namespace Craft;

class TournamentData_IndividualController extends BaseController
{
    protected $allowAnonymous = true;

    public function actionSaveIndividual()
    {
        $this->requirePostRequest();

        $individual = new TournamentData_IndividualModel();

        $individual->firstname  = craft()->request->getPost("firstname");
        $individual->lastname   = craft()->request->getPost("lastname");
        $individual->isActive   = filter_var(craft()->request->getPost("isActive"), FILTER_VALIDATE_BOOLEAN);

        if(craft()->tournamentData_individual->saveIndividual($individual))
        {
            craft()->userSession->setNotice(Craft::t('Individual saved.'));
        }
        else
        {
            // Prepare a flash error message for the user.
            craft()->userSession->setError(Craft::t("Couldn't save individual."));

            // Make the ingredient model available to the template as a 'individual' variable,
            // since it contains the user's dumb input as well as the validation errors.
            craft()->urlManager->setRouteVariables(array('individual' => $individual));
        }
        $this->redirectToPostedUrl();
    }

    public function actionDeleteIndividual()
    {
        $this->requirePostRequest();

        $individualId = $_POST["id"];

        if(craft()->tournamentdata_individual->deleteIndividualById($individualId))
        {
            craft()->userSession->setNotice(Craft::t('Individual deleted.'));
            $this->redirectToPostedUrl();
        }
        else
        {
            // Prepare a flash error message for the user.
            craft()->userSession->setError(Craft::t("Couldn't delete individual."));

            // Make the ingredient model available to the template as a 'individual' variable,
            // since it contains the user's dumb input as well as the validation errors.
            craft()->urlManager->setRouteVariables(array('individualId' => $individualId));
        }
    }

    public function actionUndoDeleteIndividual()
    {
        $this->requirePostRequest();

        $individualId = $_POST["id"];
        
        if(craft()->tournamentdata_individual->undoDeleteIndividualById($individualId))
        {
            craft()->userSession->setNotice(Craft::t('Individual deletion undone.'));
            $this->redirectToPostedUrl();
        }
        else
        {
            // Prepare a flash error message for the user.
            craft()->userSession->setError(Craft::t("Couldn't undo deletion."));

            // Make the ingredient model available to the template as a 'individual' variable,
            // since it contains the user's dumb input as well as the validation errors.
            craft()->urlManager->setRouteVariables(array('individualId' => $individualId));
        }
    }



    public function actionSaveIndividualRound()
    {
        $this->requirePostRequest();

        $individualRound = new TournamentData_IndividualRoundModel();

        $individualRound->individualId      = craft()->request->getPost("individualId");
        $individualRound->tournamentRoundId = craft()->request->getPost("tournamentroundId");
        $individualRound->isActive          = filter_var(craft()->request->getPost("isActive"), FILTER_VALIDATE_BOOLEAN);

        if(craft()->tournamentData_individual->saveIndividual($individual))
        {
            craft()->userSession->setNotice(Craft::t('Individual saved.'));
        }
        else
        {
            // Prepare a flash error message for the user.
            craft()->userSession->setError(Craft::t("Couldn't save individual."));

            // Make the ingredient model available to the template as a 'individual' variable,
            // since it contains the user's dumb input as well as the validation errors.
            craft()->urlManager->setRouteVariables(array('individualRound' => $individualRound));
        }
        $this->redirectToPostedUrl();
    }

    public function actionDeleteIndividualRound()
    {
        $this->requirePostRequest();

        $roundId = $_POST["id"];
        if(craft()->tournamentdata_individualRound->deleteIndividualRoundById($roundId))
        {
            craft()->userSession->setNotice(Craft::t('Individual Round deleted.'));
            $this->redirectToPostedUrl();
        }
        else
        {
            // Prepare a flash error message for the user.
            craft()->userSession->setError(Craft::t("Couldn't delete individualRound."));

            // Make the ingredient model available to the template as a 'individualRound' variable,
            // since it contains the user's dumb input as well as the validation errors.
            craft()->urlManager->setRouteVariables(array('roundId' => $roundId));
        }
    }

    public function actionUndoDeleteIndividualRound()
    {
        $this->requirePostRequest();

        $roundId = $_POST["id"];
        if(craft()->tournamentdata_individualRound->undoDeleteIndividualRoundById($roundId))
        {
            craft()->userSession->setNotice(Craft::t('Individual Round deletion undone.'));
            $this->redirectToPostedUrl();
        }
        else
        {
            // Prepare a flash error message for the user.
            craft()->userSession->setError(Craft::t("Couldn't undo deletion."));

            // Make the ingredient model available to the template as a 'individualRound' variable,
            // since it contains the user's dumb input as well as the validation errors.
            craft()->urlManager->setRouteVariables(array('roundId' => $roundId));
        }
    }

    public function actionSaveIndividualTournament()
    {
        $this->requirePostRequest();

        $individualTournament = new TournamentData_IndividualTournamentModel();

        $individualTournamentModel->individualroundId   = craft()->request->getPost("individualroundId");
		$individualTournamentModel->divisionId          = craft()->request->getPost("divisionId");;
	    $individualTournamentModel->notes               = craft()->request->getPost("notes");
        $individualTournamentModel->points              = craft()->request->getPost("points");;
		$individualTournamentModel->isActive            = filter_var(craft()->request->getPost("isActive"), FILTER_VALIDATE_BOOLEAN);

        if(craft()->tournamentData_individual->saveIndividualTournament($individualTournamentModel))
        {
            craft()->userSession->setNotice(Craft::t('Individual Tournament saved.'));
        }
        else
        {
            // Prepare a flash error message for the user.
            craft()->userSession->setError(Craft::t("Couldn't save individual tournament."));

            // Make the ingredient model available to the template as a 'individual' variable,
            // since it contains the user's dumb input as well as the validation errors.
            craft()->urlManager->setRouteVariables(array('individualTournament' => $individualTournamentModel));
        }
        $this->redirectToPostedUrl();
    }

    public function actionDeleteIndividualTournament()
    {
        $this->requirePostRequest();

        if(craft()->tournamentdata_individual->deleteIndividualTournamentById($_POST['id']))
        {
            craft()->userSession->setNotice(Craft::t('Individual Tournament deleted.'));
            $this->redirectToPostedUrl();
        }
        else
        {
            // Prepare a flash error message for the user.
            craft()->userSession->setError(Craft::t("Couldn't delete individual tournament."));

            // Make the ingredient model available to the template as a 'individualRound' variable,
            // since it contains the user's dumb input as well as the validation errors.
            craft()->urlManager->setRouteVariables(array('individualTournament' => $individualTournamentModel));
        }
    }

    public function actionUndoDeleteIndividualTournament()
    {
        $this->requirePostRequest();

        $tournamentId = $_POST['id'];
        if(craft()->tournamentdata_individualRound->undoDeleteIndividualRoundById($tournamentId))
        {
            craft()->userSession->setNotice(Craft::t('Individual Tournament deletion undone.'));
            $this->redirectToPostedUrl();
        }
        else
        {
            // Prepare a flash error message for the user.
            craft()->userSession->setError(Craft::t("Couldn't undo deletion."));

            // Make the ingredient model available to the template as a 'individualRound' variable,
            // since it contains the user's dumb input as well as the validation errors.
            craft()->urlManager->setRouteVariables(array('tournamentId' => $tournamentId));
        }
    }
}