# Rule of Three

Rule of Three is a Moodle activity for exploring proportional calculations interactively. It is intended for teachers who want to provide a simple calculator inside a course and for learners who need to see how values change while preserving a direct or inverse proportion.

## Features

- Simple rule of three with direct or inverse proportion.
- Compound rule of three with two influencing quantities and a result across two situations.
- Synchronized input fields: changing one value recalculates the related values immediately.
- Step-by-step presentation of the equation, substitution, factors, and result.
- Configurable decimal precision.
- Activity completion by view using Moodle's standard completion API.
- Course logging through the standard `course_module_viewed` event.
- Backup and restore support, including links stored in the activity description.
- No learner answers or calculation history are stored.

## Activity settings

When creating the activity, the teacher chooses the calculation mode, relation type, initial values, and decimal precision. The activity description can be used to explain the exercise or provide context before the interactive calculator.

In simple mode, the four proportional values stay synchronized. In compound mode, two quantities can independently use direct or inverse relationships, while the result is recalculated from both factors.

## Requirements

Moodle 4.5 or later.
