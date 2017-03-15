<?php
namespace Craft;

class TournamentData_ChurchController extends BaseController
{
    protected $allowAnonymous = true;

    public function actionSaveChurch()
    {
        $this->requirePostRequest();
        error_log(craft()->request->getQueryString());

        $church = new TournamentData_ChurchModel();

        $church->name = craft()->request->getPost("name");
        $church->address = craft()->request->getPost("address");
        $church->isActive = (bool)craft()->request->getPost("isActive");

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
}