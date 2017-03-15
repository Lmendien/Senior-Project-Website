<?php
namespace Craft;

class TournamentData_DivisionController extends BaseController
{
    protected $allowAnonymous = true;

    public function actionSaveDivision()
    {
        $this->requirePostRequest();
        error_log(craft()->request->getQueryString());

        $division = new TournamentData_DivisionModel();

        $division->name = craft()->request->getPost("name");
        $division->isActive = (bool)craft()->request->getPost("isActive");

        if(craft()->tournamentData_division->saveDivision($division))
        {
            craft()->userSession->setNotice(Craft::t('Division saved.'));
        }
        else
        {
            // Prepare a flash error message for the user.
            craft()->userSession->setError(Craft::t("Couldn't save division."));

            // Make the ingredient model available to the template as a 'division' variable,
            // since it contains the user's dumb input as well as the validation errors.
            craft()->urlManager->setRouteVariables(array('division' => $division));
        }
        $this->redirectToPostedUrl();
    }

    public function actionDeleteDivision()
    {
        $this->requirePostRequest();

        if(craft()->tournamentData_division->deleteDivisionById($_POST['id']))
        {
            craft()->userSession->setNotice(Craft::t('Division deleted.'));
            $this->redirectToPostedUrl();
        }
        else
        {
            // Prepare a flash error message for the user.
            craft()->userSession->setError(Craft::t("Couldn't delete division."));

            // Make the ingredient model available to the template as a 'division' variable,
            // since it contains the user's dumb input as well as the validation errors.
            craft()->urlManager->setRouteVariables(array('division' => $division));
        }
    }

    public function actionUndoDeleteDivision()
    {
        $this->requirePostRequest();

        if(craft()->tournamentData_division->undoDeleteDivisionById($_POST['id']))
        {
            craft()->userSession->setNotice(Craft::t('Division deletion undone.'));
            $this->redirectToPostedUrl();
        }
        else
        {
            // Prepare a flash error message for the user.
            craft()->userSession->setError(Craft::t("Couldn't undo deletion."));

            // Make the ingredient model available to the template as a 'division' variable,
            // since it contains the user's dumb input as well as the validation errors.
            craft()->urlManager->setRouteVariables(array('division' => $division));
        }
    }
}