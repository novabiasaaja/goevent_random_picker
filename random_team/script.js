document.addEventListener('DOMContentLoaded', () => {
    const generateBtn = document.getElementById('generateBtn');
    const nameListTextarea = document.getElementById('nameList');
    const teamCountInput = document.getElementById('teamCount');
    const resultContainer = document.getElementById('resultContainer');
    const messageEl = document.getElementById('message');

    generateBtn.addEventListener('click', () => {
        // Clear previous messages and results
        messageEl.textContent = '';
        messageEl.className = 'message';
        resultContainer.innerHTML = '';

        // Get and clean the list of names and the team count
        const names = nameListTextarea.value.split('\n')
            .map(name => name.trim())
            .filter(name => name !== '');
        const teamCount = parseInt(teamCountInput.value, 10);

        // --- Validation Section ---
        if (names.length === 0 || isNaN(teamCount) || teamCount < 2) {
            messageEl.textContent = 'Please enter a valid list of names and a team count (minimum 2 teams).';
            messageEl.classList.add('error');
            return;
        }

        if (teamCount > names.length) {
            messageEl.textContent = 'The number of teams cannot be more than the number of people.';
            messageEl.classList.add('error');
            return;
        }

        // Hide the example text
        const exampleText = document.querySelector('.result-section .example-text');
        if (exampleText) {
            exampleText.style.display = 'none';
        }

        messageEl.textContent = 'Generating teams...';
        messageEl.classList.add('success');

        // --- Core Logic Section ---
        // A shuffle function to randomize the array
        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
        }

        // Shuffle the names to ensure random distribution
        shuffleArray(names);

        // Create an array to hold the teams
        const teams = Array.from({ length: teamCount }, () => []);

        // Distribute names evenly among the teams
        for (let i = 0; i < names.length; i++) {
            const teamIndex = i % teamCount;
            teams[teamIndex].push(names[i]);
        }

        // --- Rendering Section ---
        teams.forEach((team, index) => {
            const teamBox = document.createElement('div');
            teamBox.className = 'team-box';

            const teamTitle = document.createElement('h3');
            teamTitle.textContent = `Team ${index + 1}`;
            teamBox.appendChild(teamTitle);

            const teamList = document.createElement('ul');
            if (team.length === 0) {
                const emptyItem = document.createElement('li');
                emptyItem.textContent = 'No members';
                teamList.appendChild(emptyItem);
            } else {
                team.forEach(member => {
                    const memberItem = document.createElement('li');
                    memberItem.textContent = member;
                    teamList.appendChild(memberItem);
                });
            }
            teamBox.appendChild(teamList);
            resultContainer.appendChild(teamBox);
        });

        // Final success message
        messageEl.textContent = `Successfully generated ${teamCount} teams.`;
        messageEl.classList.add('success');
    });
});