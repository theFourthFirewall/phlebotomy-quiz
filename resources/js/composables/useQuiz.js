import { ref, computed } from 'vue'

const questions = ref([])
const currentQuestionIndex = ref(0)
const userAnswers = ref([])
const isLoading = ref(false)
const error = ref(null)
const isQuizCompleted = ref(false)

export function useQuiz() {
  // Computed properties
  const currentQuestion = computed(() => {
    return questions.value[currentQuestionIndex.value] || null
  })

  const progress = computed(() => {
    if (questions.value.length === 0) return 0
    return ((currentQuestionIndex.value + 1) / questions.value.length) * 100
  })

  const score = computed(() => {
    return userAnswers.value.filter(answer => answer.isCorrect).length
  })

  const totalQuestions = computed(() => questions.value.length)

  const scorePercentage = computed(() => {
    if (totalQuestions.value === 0) return 0
    return Math.round((score.value / totalQuestions.value) * 100)
  })

  // Helper function to shuffle array
  const shuffleArray = (array) => {
    const shuffled = [...array]
    for (let i = shuffled.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [shuffled[i], shuffled[j]] = [shuffled[j], shuffled[i]]
    }
    return shuffled
  }

  // Actions
  const fetchQuestions = async () => {
    isLoading.value = true
    error.value = null
    
    try {
      const response = await fetch(`${import.meta.env.VITE_API_URL}/api/questions`)
      
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`)
      }
      
      const data = await response.json()
      
      // Randomize the content but keep A, B, C, D order in UI
      const questionsWithShuffledOptions = data.map(question => {
        // Shuffle the option contents
        const shuffledOptions = shuffleArray(question.options)
        
        // Reassign to a, b, c, d in order
        const newOptions = shuffledOptions.map((option, index) => ({
          ...option,
          id: ['a', 'b', 'c', 'd'][index]
        }))
        
        // Find where the correct answer ended up
        const originalCorrectOption = question.options.find(opt => opt.id === question.correctAnswerId)
        const newCorrectIndex = shuffledOptions.findIndex(opt => opt.text === originalCorrectOption.text)
        const newCorrectAnswerId = ['a', 'b', 'c', 'd'][newCorrectIndex]
        
        return {
          ...question,
          options: newOptions,
          correctAnswerId: newCorrectAnswerId
        }
      })
      
      questions.value = questionsWithShuffledOptions
    } catch (err) {
      error.value = `Failed to load questions: ${err.message}`
      console.error('Error fetching questions:', err)
    } finally {
      isLoading.value = false
    }
  }

  const submitAnswer = (selectedOptionId) => {
    const currentQ = currentQuestion.value
    if (!currentQ) return

    const isCorrect = selectedOptionId === currentQ.correctAnswerId
    const selectedOption = currentQ.options.find(opt => opt.id === selectedOptionId)

    userAnswers.value.push({
      questionId: currentQ.id,
      selectedOptionId,
      selectedText: selectedOption?.text || '',
      correctAnswerId: currentQ.correctAnswerId,
      isCorrect,
      explanation: currentQ.explanation
    })
  }

  const nextQuestion = () => {
    if (currentQuestionIndex.value < questions.value.length - 1) {
      currentQuestionIndex.value++
    } else {
      isQuizCompleted.value = true
    }
  }

  const resetQuiz = () => {
    currentQuestionIndex.value = 0
    userAnswers.value = []
    isQuizCompleted.value = false
    error.value = null
  }

  const getAnswerForQuestion = (questionId) => {
    return userAnswers.value.find(answer => answer.questionId === questionId)
  }

  return {
    // State
    questions,
    currentQuestionIndex,
    userAnswers,
    isLoading,
    error,
    isQuizCompleted,
    
    // Computed
    currentQuestion,
    progress,
    score,
    totalQuestions,
    scorePercentage,
    
    // Actions
    fetchQuestions,
    submitAnswer,
    nextQuestion,
    resetQuiz,
    getAnswerForQuestion
  }
}