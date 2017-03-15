<?php
namespace Craft;

class TournamentData_TournamentRoundController extends BaseController
{
    protected $allowAnonymous = true;

    public function actionSaveTournamentRound()
    {
        $this->requirePostRequest();
        error_log(craft()->request->getQueryString());

        $tournamentRound = new TournamentData_TournamentRoundModel();

        $tournamentRound->round = craft()->request->getPost("round");
        $tournamentRound->tournamentId = craft()->request->getPost("tournamentId");
        $tournamentRound->isActive = (bool)craft()->request->getPost("isActive");

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
}