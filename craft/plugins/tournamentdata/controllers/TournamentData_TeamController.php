<?php
namespace Craft;

class TournamentData_TeamController extends BaseController
{
    protected $allowAnonymous = true;

    public function actionSaveTeam()
    {
        $this->requirePostRequest();
        error_log(craft()->request->getQueryString());

        $team = new TournamentData_TeamModel();

        $team->churchId         = craft()->request->getPost("churchId");
        $team->tournamentteamId = craft()->request->getPost("tournamentteamId");
        $team->isActive         = (bool)craft()->request->getPost("isActive");

        if(craft()->tournamentData_team->saveTeam($team))
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

    public function actionDeleteTeam()
    {
        $this->requirePostRequest();

        if(craft()->tournamentData_team->deleteTeamById($_POST['id']))
        {
            craft()->userSession->setNotice(Craft::t('Team deleted.'));
            $this->redirectToPostedUrl();
        }
        else
        {
            // Prepare a flash error message for the user.
            craft()->userSession->setError(Craft::t("Couldn't delete team."));

            // Make the ingredient model available to the template as a 'tournament' variable,
            // since it contains the user's dumb input as well as the validation errors.
            craft()->urlManager->setRouteVariables(array('team' => $tournament));
        }
    }

    public function actionUndoDeleteTeam()
    {
        $this->requirePostRequest();

        if(craft()->tournamentData_team->undoDeleteTeamById($_POST['id']))
        {
            craft()->userSession->setNotice(Craft::t('Team deletion undone.'));
            $this->redirectToPostedUrl();
        }
        else
        {
            // Prepare a flash error message for the user.
            craft()->userSession->setError(Craft::t("Couldn't undo deletion."));

            // Make the ingredient model available to the template as a 'tournament' variable,
            // since it contains the user's dumb input as well as the validation errors.
            craft()->urlManager->setRouteVariables(array('team' => $tournament));
        }
    }


    public function actionSaveTeamMember()
    {
        $this->requirePostRequest();
        error_log(craft()->request->getQueryString());

        $teamMember = new TournamentData_TeamMemberModel();

        $teamMember->churchteamId = craft()->request->getPost("churchteamId");
        $teamMember->individualId = craft()->request->getPost("individualId");
        $teamMember->isActive     = (bool)craft()->request->getPost("isActive");

        if(craft()->tournamentData_team->saveTeamMember($teamMember))
        {
            craft()->userSession->setNotice(Craft::t('Team Round saved.'));
        }
        else
        {
            // Prepare a flash error message for the user.
            craft()->userSession->setError(Craft::t("Couldn't save team round."));

            // Make the ingredient model available to the template as a 'tournamentRound' variable,
            // since it contains the user's dumb input as well as the validation errors.
            craft()->urlManager->setRouteVariables(array('teamMember' => $teamMember));
        }
        $this->redirectToPostedUrl();
    }

    public function actionDeleteTeamMember()
    {
        $this->requirePostRequest();

        if(craft()->tournamentData_team->deleteTeamMemberById($_POST['id']))
        {
            craft()->userSession->setNotice(Craft::t('TeamMember deleted.'));
            $this->redirectToPostedUrl();
        }
        else
        {
            // Prepare a flash error message for the user.
            craft()->userSession->setError(Craft::t("Couldn't delete teamMember."));

            // Make the ingredient model available to the template as a 'tournamentRound' variable,
            // since it contains the user's dumb input as well as the validation errors.
            craft()->urlManager->setRouteVariables(array('teamMember' => $teamMember));
        }
    }

    public function actionUndoDeleteTeamMember()
    {
        $this->requirePostRequest();

        if(craft()->tournamentData_team->undoDeleteTeamMemberById($_POST['id']))
        {
            craft()->userSession->setNotice(Craft::t('TeamMember deletion undone.'));
            $this->redirectToPostedUrl();
        }
        else
        {
            // Prepare a flash error message for the user.
            craft()->userSession->setError(Craft::t("Couldn't undo deletion."));

            // Make the ingredient model available to the template as a 'tournamentRound' variable,
            // since it contains the user's dumb input as well as the validation errors.
            craft()->urlManager->setRouteVariables(array('teamMember' => $teamMember));
        }
    }
}