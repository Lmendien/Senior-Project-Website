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

        $tournament->name = craft()->request->getPost("name");
        $tournament->address = craft()->request->getPost("address");
        $tournament->date = craft()->request->getPost("date");
        $tournament->portion = craft()->request->getPost("portion");
        $tournament->final = (bool)craft()->request->getPost("final");
        $tournament->isActive = (bool)craft()->request->getPost("isActive");

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
}