<?php
namespace Craft;

class TournamentData_TournamentController extends BaseController
{
    protected $allowAnonymous = true;

    public function actionSaveTournament()
    {
        $this->requirePostRequest();
        error_log(craft()->request->getQueryString());

        $tournament = new TournamentData_TournamentModel();

        $tournament->name       = craft()->request->getPost("name");
        $tournament->address    = craft()->request->getPost("address");
        $tournament->date       = craft()->request->getPost("date");
        $tournament->portion    = craft()->request->getPost("portion");
        $tournament->final      = (bool)craft()->request->getPost("final");
        $tournament->isActive   = (bool)craft()->request->getPost("isActive");

        if(craft()->tournamentData_tournament->saveTournament($tournament))
        {
            craft()->userSession->setNotice(Craft::t('Tournament saved.'));
        }
        else
        {
            // Prepare a flash error message for the user.
            craft()->userSession->setError(Craft::t("Couldn't save tournament."));

            // Make the ingredient model available to the template as a 'tournament' variable,
            // since it contains the user's dumb input as well as the validation errors.
            craft()->urlManager->setRouteVariables(array('tournament' => $tournament));
        }
        $this->redirectToPostedUrl();
    }

    public function actionDeleteTournament()
    {
        $this->requirePostRequest();

        if(craft()->tournamentdata_tournament->deleteTournamentById($_POST['id']))
        {
            craft()->userSession->setNotice(Craft::t('Tournament deleted.'));
            $this->redirectToPostedUrl();
        }
        else
        {
            // Prepare a flash error message for the user.
            craft()->userSession->setError(Craft::t("Couldn't delete tournament."));

            // Make the ingredient model available to the template as a 'tournament' variable,
            // since it contains the user's dumb input as well as the validation errors.
            craft()->urlManager->setRouteVariables(array('tournament' => $tournament));
        }
    }

    public function actionUndoDeleteTournament()
    {
        $this->requirePostRequest();

        if(craft()->tournamentdata_tournament->undoDeleteTournamentById($_POST['id']))
        {
            craft()->userSession->setNotice(Craft::t('Tournament deletion undone.'));
            $this->redirectToPostedUrl();
        }
        else
        {
            // Prepare a flash error message for the user.
            craft()->userSession->setError(Craft::t("Couldn't undo deletion."));

            // Make the ingredient model available to the template as a 'tournament' variable,
            // since it contains the user's dumb input as well as the validation errors.
            craft()->urlManager->setRouteVariables(array('tournament' => $tournament));
        }
    }


    public function actionSaveTournamentRound()
    {
        $this->requirePostRequest();
        error_log(craft()->request->getQueryString());

        $tournamentRound = new TournamentData_TournamentRoundModel();

        $tournamentRound->round         = craft()->request->getPost("round");
        $tournamentRound->tournamentId  = craft()->request->getPost("tournamentId");
        $tournamentRound->isActive      = (bool)craft()->request->getPost("isActive");

        if(craft()->tournamentData_tournamentRound->saveTournamentRound($tournamentRound))
        {
            craft()->userSession->setNotice(Craft::t('Tournament Round saved.'));
        }
        else
        {
            // Prepare a flash error message for the user.
            craft()->userSession->setError(Craft::t("Couldn't save tournament round."));

            // Make the ingredient model available to the template as a 'tournamentRound' variable,
            // since it contains the user's dumb input as well as the validation errors.
            craft()->urlManager->setRouteVariables(array('tournamentRound' => $tournamentRound));
        }
        $this->redirectToPostedUrl();
    }

    public function actionDeleteTournamentRound()
    {
        $this->requirePostRequest();

        if(craft()->tournamentdata_tournamentRound->deleteTournamentRoundById($_POST['id']))
        {
            craft()->userSession->setNotice(Craft::t('TournamentRound deleted.'));
            $this->redirectToPostedUrl();
        }
        else
        {
            // Prepare a flash error message for the user.
            craft()->userSession->setError(Craft::t("Couldn't delete tournamentRound."));

            // Make the ingredient model available to the template as a 'tournamentRound' variable,
            // since it contains the user's dumb input as well as the validation errors.
            craft()->urlManager->setRouteVariables(array('tournamentRound' => $tournamentRound));
        }
    }

    public function actionUndoDeleteTournamentRound()
    {
        $this->requirePostRequest();

        if(craft()->tournamentdata_tournamentRound->undoDeleteTournamentRoundById($_POST['id']))
        {
            craft()->userSession->setNotice(Craft::t('TournamentRound deletion undone.'));
            $this->redirectToPostedUrl();
        }
        else
        {
            // Prepare a flash error message for the user.
            craft()->userSession->setError(Craft::t("Couldn't undo deletion."));

            // Make the ingredient model available to the template as a 'tournamentRound' variable,
            // since it contains the user's dumb input as well as the validation errors.
            craft()->urlManager->setRouteVariables(array('tournamentRound' => $tournamentRound));
        }
    }


    public function actionSaveTournamentTeam()
    {
        $this->requirePostRequest();
        error_log(craft()->request->getQueryString());

        $tournamentTeam = new TournamentData_TournamentTeamModel();

        $tournamentTeam->teamnumber     = craft()->request->getPost("teamnumber");
        $tournamentTeam->tournamentId   = craft()->request->getPost("tournamentId");
        $tournamentTeam->isActive       = (bool)craft()->request->getPost("isActive");

        if(craft()->tournamentData_tournamentRound->saveTournamentRound($tournamentTeam))
        {
            craft()->userSession->setNotice(Craft::t('Tournament Team saved.'));
        }
        else
        {
            // Prepare a flash error message for the user.
            craft()->userSession->setError(Craft::t("Couldn't save tournament round."));

            // Make the ingredient model available to the template as a 'tournamentRound' variable,
            // since it contains the user's dumb input as well as the validation errors.
            craft()->urlManager->setRouteVariables(array('tournamentTeam' => $tournamentTeam));
        }
        $this->redirectToPostedUrl();
    }

    public function actionDeleteTournamentTeam()
    {
        $this->requirePostRequest();

        $tournamentTeamId = $_POST["id"];

        if(craft()->tournamentdata_tournamentRound->deleteTournamentRoundById($tournamentTeamId))
        {
            craft()->userSession->setNotice(Craft::t('Tournament Team deleted.'));
            $this->redirectToPostedUrl();
        }
        else
        {
            // Prepare a flash error message for the user.
            craft()->userSession->setError(Craft::t("Couldn't delete tournament team."));

            // Make the ingredient model available to the template as a 'tournamentRound' variable,
            // since it contains the user's dumb input as well as the validation errors.
            craft()->urlManager->setRouteVariables(array('tournamentTeam' => $tournamentTeamId));
        }
    }

    public function actionUndoDeleteTournamentTeam()
    {
        $this->requirePostRequest();

        $tournamentTeamId = $_POST["id"];

        if(craft()->tournamentdata_tournamentRound->undoDeleteTournamentRoundById($tournamentTeamId))
        {
            craft()->userSession->setNotice(Craft::t('Tournament Team deletion undone.'));
            $this->redirectToPostedUrl();
        }
        else
        {
            // Prepare a flash error message for the user.
            craft()->userSession->setError(Craft::t("Couldn't undo deletion."));

            // Make the ingredient model available to the template as a 'tournamentRound' variable,
            // since it contains the user's dumb input as well as the validation errors.
            craft()->urlManager->setRouteVariables(array('tournamentTeam' => $tournamentTeamId));
        }
    }
}