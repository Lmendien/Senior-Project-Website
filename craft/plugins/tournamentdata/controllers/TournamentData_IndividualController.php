<?php
namespace Craft;

class TournamentData_IndividualController extends BaseController
{
    protected $allowAnonymous = true;

    public function actionSaveIndividual()
    {
        $this->requirePostRequest();
        error_log(craft()->request->getQueryString());

        $individual = new TournamentData_IndividualModel();

        $individual->firstname = craft()->request->getPost("firstname");
        $individual->lastname = craft()->request->getPost("lastname");
        $individual->isActive = (bool)craft()->request->getPost("isActive");

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

        if(craft()->tournamentdata_individual->deleteIndividualById($_POST['id']))
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
            craft()->urlManager->setRouteVariables(array('individual' => $individual));
        }
    }

    public function actionUndoDeleteIndividual()
    {
        $this->requirePostRequest();

        if(craft()->tournamentdata_individual->undoDeleteIndividualById($_POST['id']))
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
            craft()->urlManager->setRouteVariables(array('individual' => $individual));
        }
    }
}