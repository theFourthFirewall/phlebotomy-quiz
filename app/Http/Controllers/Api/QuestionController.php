<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = [
            [
                'id' => 1,
                'scenario' => 'You are preparing to draw blood from an anxious patient who says they often faint. The patient\'s record shows no contraindications.',
                'question' => 'What is the most appropriate course of action to ensure patient safety?',
                'options' => [
                    ['id' => 'a', 'text' => 'Proceed with the draw as normal.'],
                    ['id' => 'b', 'text' => 'Have the patient lie down for the procedure.'],
                    ['id' => 'c', 'text' => 'Offer the patient a glass of water.'],
                    ['id' => 'd', 'text' => 'Ask a colleague to assist you.']
                ],
                'correctAnswerId' => 'b',
                'explanation' => 'Having a patient with a history of fainting lie down is the safest position to prevent injury from a fall.'
            ],
            [
                'id' => 2,
                'scenario' => 'A patient arrives for a blood draw but mentions they just finished a heavy meal 15 minutes ago. The test order is for fasting glucose.',
                'question' => 'What should you do in this situation?',
                'options' => [
                    ['id' => 'a', 'text' => 'Proceed with the blood draw anyway.'],
                    ['id' => 'b', 'text' => 'Reschedule the appointment for another day.'],
                    ['id' => 'c', 'text' => 'Wait 30 minutes and then draw the blood.'],
                    ['id' => 'd', 'text' => 'Draw the blood but note on the requisition that the patient was not fasting.']
                ],
                'correctAnswerId' => 'b',
                'explanation' => 'Fasting glucose tests require the patient to fast for 8-12 hours. The test must be rescheduled to ensure accurate results.'
            ],
            [
                'id' => 3,
                'scenario' => 'You notice that a colleague is not wearing gloves while handling blood specimens in the laboratory.',
                'question' => 'What is the most appropriate immediate action?',
                'options' => [
                    ['id' => 'a', 'text' => 'Report them to the supervisor immediately.'],
                    ['id' => 'b', 'text' => 'Remind them about the importance of wearing gloves.'],
                    ['id' => 'c', 'text' => 'Ignore it as it\'s not your responsibility.'],
                    ['id' => 'd', 'text' => 'Wait until after their shift to discuss it.']
                ],
                'correctAnswerId' => 'b',
                'explanation' => 'Immediate intervention is necessary for safety. A friendly reminder is the appropriate first response to protect both the colleague and patients.'
            ],
            [
                'id' => 4,
                'scenario' => 'During a routine blood draw, you accidentally stick yourself with a used needle.',
                'question' => 'What is the first action you should take?',
                'options' => [
                    ['id' => 'a', 'text' => 'Complete the blood draw first.'],
                    ['id' => 'b', 'text' => 'Wash the area immediately with soap and water.'],
                    ['id' => 'c', 'text' => 'Apply a bandage to stop any bleeding.'],
                    ['id' => 'd', 'text' => 'Report to your supervisor.']
                ],
                'correctAnswerId' => 'b',
                'explanation' => 'Immediate washing with soap and water is the first critical step after a needlestick injury to reduce the risk of infection.'
            ],
            [
                'id' => 5,
                'scenario' => 'An elderly patient with fragile veins requires a blood draw. You\'ve already attempted twice without success.',
                'question' => 'What is the best course of action?',
                'options' => [
                    ['id' => 'a', 'text' => 'Try a third time in a different location.'],
                    ['id' => 'b', 'text' => 'Ask a more experienced colleague to attempt the draw.'],
                    ['id' => 'c', 'text' => 'Send the patient home without completing the draw.'],
                    ['id' => 'd', 'text' => 'Use a larger gauge needle for better success.']
                ],
                'correctAnswerId' => 'b',
                'explanation' => 'After two unsuccessful attempts, it\'s best practice to seek assistance from a more experienced colleague to minimize patient discomfort.'
            ],
            [
                'id' => 6,
                'scenario' => 'A patient requests that you use their left arm for the blood draw, but you notice an IV line in that arm.',
                'question' => 'How should you proceed?',
                'options' => [
                    ['id' => 'a', 'text' => 'Use the left arm as requested, avoiding the IV site.'],
                    ['id' => 'b', 'text' => 'Explain why you cannot use that arm and use the right arm instead.'],
                    ['id' => 'c', 'text' => 'Draw blood from below the IV site.'],
                    ['id' => 'd', 'text' => 'Remove the IV temporarily to draw blood.']
                ],
                'correctAnswerId' => 'b',
                'explanation' => 'Drawing blood from an arm with an IV can contaminate the sample. You must use the opposite arm and explain this to the patient.'
            ],
            [
                'id' => 7,
                'scenario' => 'You\'re preparing to draw blood when you realize you forgot to label the tubes beforehand.',
                'question' => 'What should you do?',
                'options' => [
                    ['id' => 'a', 'text' => 'Draw the blood and label the tubes immediately after.'],
                    ['id' => 'b', 'text' => 'Label the tubes before drawing blood.'],
                    ['id' => 'c', 'text' => 'Draw the blood and label the tubes when you return to the lab.'],
                    ['id' => 'd', 'text' => 'Ask the patient to wait while you get pre-labeled tubes.']
                ],
                'correctAnswerId' => 'b',
                'explanation' => 'Tubes should always be labeled before drawing blood to prevent any possibility of mislabeling or mixing up specimens.'
            ],
            [
                'id' => 8,
                'scenario' => 'A pediatric patient is crying and refuses to extend their arm for the blood draw.',
                'question' => 'What is the most appropriate approach?',
                'options' => [
                    ['id' => 'a', 'text' => 'Have the parent forcibly hold the child\'s arm.'],
                    ['id' => 'b', 'text' => 'Wait for the child to calm down and try to gain their cooperation.'],
                    ['id' => 'c', 'text' => 'Proceed quickly while the child is distracted.'],
                    ['id' => 'd', 'text' => 'Reschedule for when the child might be more cooperative.']
                ],
                'correctAnswerId' => 'b',
                'explanation' => 'Patience and gaining the child\'s cooperation is important for a safe procedure and positive experience. Forcing the procedure can cause trauma.'
            ],
            [
                'id' => 9,
                'scenario' => 'You notice that the tourniquet has been on a patient\'s arm for over 2 minutes while you search for a suitable vein.',
                'question' => 'What should you do?',
                'options' => [
                    ['id' => 'a', 'text' => 'Continue searching as you\'ve already invested time.'],
                    ['id' => 'b', 'text' => 'Release the tourniquet, let the arm rest, then reapply.'],
                    ['id' => 'c', 'text' => 'Tighten the tourniquet to make veins more visible.'],
                    ['id' => 'd', 'text' => 'Switch to the other arm immediately.']
                ],
                'correctAnswerId' => 'b',
                'explanation' => 'Tourniquets should not be left on for more than 1-2 minutes as this can affect test results and cause patient discomfort. Release and reapply after letting the arm rest.'
            ],
            [
                'id' => 10,
                'scenario' => 'A patient mentions they are on blood thinners after you\'ve already inserted the needle.',
                'question' => 'How does this information affect your procedure?',
                'options' => [
                    ['id' => 'a', 'text' => 'Remove the needle immediately and cancel the procedure.'],
                    ['id' => 'b', 'text' => 'Complete the draw and apply pressure for a longer time after.'],
                    ['id' => 'c', 'text' => 'No change needed to the procedure.'],
                    ['id' => 'd', 'text' => 'Draw less blood than ordered.']
                ],
                'correctAnswerId' => 'b',
                'explanation' => 'Patients on blood thinners can still have blood drawn safely, but require extended pressure time (3-5 minutes) to ensure proper clotting.'
            ],
            [
                'id' => 11,
                'scenario' => 'You\'re about to perform a blood draw when you notice the patient\'s identification bracelet has a different name than on your requisition.',
                'question' => 'What is the correct action?',
                'options' => [
                    ['id' => 'a', 'text' => 'Proceed if the patient verbally confirms their identity.'],
                    ['id' => 'b', 'text' => 'Stop and resolve the discrepancy before proceeding.'],
                    ['id' => 'c', 'text' => 'Use the name on the requisition for labeling.'],
                    ['id' => 'd', 'text' => 'Use the name on the bracelet for labeling.']
                ],
                'correctAnswerId' => 'b',
                'explanation' => 'Any discrepancy in patient identification must be resolved before proceeding. This is a critical safety issue that could lead to serious medical errors.'
            ],
            [
                'id' => 12,
                'scenario' => 'During a blood culture collection, you accidentally touch the top of the collection bottle after cleaning it.',
                'question' => 'What should you do?',
                'options' => [
                    ['id' => 'a', 'text' => 'Proceed with the collection as the inside is still sterile.'],
                    ['id' => 'b', 'text' => 'Clean the top again with a new alcohol pad.'],
                    ['id' => 'c', 'text' => 'Get a new collection bottle.'],
                    ['id' => 'd', 'text' => 'Note the contamination on the requisition.']
                ],
                'correctAnswerId' => 'b',
                'explanation' => 'If the cleaned area is contaminated, it must be cleaned again to prevent false positive results in the blood culture.'
            ],
            [
                'id' => 13,
                'scenario' => 'A patient asks you what tests their doctor ordered while you\'re preparing for the blood draw.',
                'question' => 'How should you respond?',
                'options' => [
                    ['id' => 'a', 'text' => 'Read all the tests from the requisition form.'],
                    ['id' => 'b', 'text' => 'Tell them you cannot share that information.'],
                    ['id' => 'c', 'text' => 'Suggest they ask their doctor for this information.'],
                    ['id' => 'd', 'text' => 'Only mention the basic tests like CBC.']
                ],
                'correctAnswerId' => 'c',
                'explanation' => 'While patients have the right to their information, phlebotomists should direct medical questions to the ordering physician who can properly explain the tests and their purpose.'
            ],
            [
                'id' => 14,
                'scenario' => 'You notice that a specimen tube for a coagulation test is only filled to 75% capacity.',
                'question' => 'What is the appropriate action?',
                'options' => [
                    ['id' => 'a', 'text' => 'Send it to the lab as is.'],
                    ['id' => 'b', 'text' => 'Add more blood from another tube.'],
                    ['id' => 'c', 'text' => 'Redraw the specimen in a new tube.'],
                    ['id' => 'd', 'text' => 'Note the underfill on the requisition.']
                ],
                'correctAnswerId' => 'c',
                'explanation' => 'Coagulation tests require exact blood-to-anticoagulant ratios. Underfilled tubes will give inaccurate results and must be recollected.'
            ],
            [
                'id' => 15,
                'scenario' => 'After completing a blood draw, you realize you forgot to have the patient sign the consent form beforehand.',
                'question' => 'What should you do?',
                'options' => [
                    ['id' => 'a', 'text' => 'Have them sign it now and backdate it.'],
                    ['id' => 'b', 'text' => 'Have them sign it now with the current time.'],
                    ['id' => 'c', 'text' => 'Proceed without the signature since the procedure is done.'],
                    ['id' => 'd', 'text' => 'Discard the samples and redraw after getting consent.']
                ],
                'correctAnswerId' => 'b',
                'explanation' => 'Have the patient sign with the current time and document the oversight. Never backdate medical documents as this is considered falsification.'
            ]
        ];

        return response()->json($questions);
    }
}
