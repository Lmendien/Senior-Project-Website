<?php
namespace Craft;

class TournamentData_ChurchController extends BaseController
{
    protected $allowAnonymous = true;

    public function actionSaveChurch()
    {
        $this->requirePostRequest();

        $church = new TournamentData_ChurchModel();

        $church->name       = craft()->request->getPost("name");
        $church->address    = craft()->request->getPost("address");
        $church->isActive   = filter_var(craft()->request->getPost("isActive"), FILTER_VALIDATE_BOOLEAN);

        if(craft()->tournamentData_church->saveChurch($church))
        {
            craft()->userSession->setNotice(Craft::t('Church saved.'));
        }
        else
        {
            // Prepare a flash error message for the user.
            craft()->userSession->setError(Craft::t("Couldn't save church."));

            // Make the ingredient model available to the template as a 'church' variable,
            // since it contains the user's dumb input as well as the validation errors.
            craft()->urlManager->setRouteVariables(array('church' => $church));
        }
        $this->redirectToPostedUrl();
    }

    public function actionDeleteChurch()
    {
        $this->requirePostRequest();

        if(craft()->tournamentdata_church->deleteChurchById($_POST['id']))
        {
            craft()->userSession->setNotice(Craft::t('Church deleted.'));
            $this->redirectToPostedUrl();
        }
        else
        {
            // Prepare a flash error message for the user.
            craft()->userSession->setError(Craft::t("Couldn't delete church."));

            // Make the ingredient model available to the template as a 'church' variable,
            // since it contains the user's dumb input as well as the validation errors.
            craft()->urlManager->setRouteVariables(array('church' => $church));
        }
    }

    public function actionUndoDeleteChurch()
    {
        $this->requirePostRequest();

        if(craft()->tournamentdata_church->undoDeleteChurchById($_POST['id']))
        {
            craft()->userSession->setNotice(Craft::t('Church deletion undone.'));
            $this->redirectToPostedUrl();
        }
        else
        {
            // Prepare a flash error message for the user.
            craft()->userSession->setError(Craft::t("Couldn't undo deletion."));

            // Make the ingredient model available to the template as a 'church' variable,
            // since it contains the user's dumb input as well as the validation errors.
            craft()->urlManager->setRouteVariables(array('church' => $church));
        }
    }



    public function actionSaveChurchTeam()
    {
        $this->requirePostRequest();

        $churchTeam = new TournamentData_ChurchTeamModel();

        $churchTeam->churchId = craft()->request->getPost("churchId");
        $churchTeam->tournamentteamId = craft()->request->getPost("tournamentteamId");
        $churchTeam->isActive = filter_var(craft()->request->getPost("isActive"), FILTER_VALIDATE_BOOLEAN);;

        if(craft()->tournamentData_church->saveChurchTeam($church))
        {
            craft()->userSession->setNotice(Craft::t('Church saved.'));
        }
        else
        {
            // Prepare a flash error message for the user.
            craft()->userSession->setError(Craft::t("Couldn't save church."));

            // Make the ingredient model available to the template as a 'church' variable,
            // since it contains the user's dumb input as well as the validation errors.
            craft()->urlManager->setRouteVariables(array('church' => $church));
        }
        $this->redirectToPostedUrl();
    }

    public function actionDeleteChurchTeam()
    {
        $this->requirePostRequest();

        if(craft()->tournamentdata_church->deleteChurchTeamById($_POST['id']))
        {
            craft()->userSession->setNotice(Craft::t('Church deleted.'));
            $this->redirectToPostedUrl();
        }
        else
        {
            // Prepare a flash error message for the user.
            craft()->userSession->setError(Craft::t("Couldn't delete church."));

            // Make the ingredient model available to the template as a 'church' variable,
            // since it contains the user's dumb input as well as the validation errors.
            craft()->urlManager->setRouteVariables(array('church' => $church));
        }
    }

    public function actionUndoDeleteChurchTeam()
    {
        $this->requirePostRequest();

        if(craft()->tournamentdata_church->undoDeleteChurchTeamById($_POST['id']))
        {
            craft()->userSession->setNotice(Craft::t('Church deletion undone.'));
            $this->redirectToPostedUrl();
        }
        else
        {
            // Prepare a flash error message for the user.
            craft()->userSession->setError(Craft::t("Couldn't undo deletion."));

            // Make the ingredient model available to the template as a 'church' variable,
            // since it contains the user's dumb input as well as the validation errors.
            craft()->urlManager->setRouteVariables(array('church' => $church));
        }
    }
}