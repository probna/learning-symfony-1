Feature: Log out a logged in user
  In order to be able to log out
  As a regular user
  I need to be logged in

  Scenario: As a logged in user, I need to be able to log out
#    log in
    Given I am on "/login"
    And I fill in "_username" with "tomo.omot"
    And I fill in "_password" with "12345"
    And I press "Prijava"
    Then I should be on "/"
#    confirm login
    And I visit "/profile"
    And I should see text matching "Korisničko ime: tomo.omot"
#    log out
    And I visit "/logout"
    Then I should be on "/"
#    confirm logout
    And I visit "/profile"
    Then I should be on "/login"

