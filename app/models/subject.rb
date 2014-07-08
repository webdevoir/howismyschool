class Subject < ActiveRecord::Base
  belongs_to :school_branch
  belongs_to :creator, polymorphic: true
  belongs_to :document

  has_many :test_results, dependent: :destroy

  validates :name,
    presence: true,
    uniqueness: {
      scope: [:school_branch_id]
    }

  class << self
    def get_subjects_array_for_select_option(school_branch_id: nil)
      select(:id, :name).
      where(
          school_branch_id: school_branch_id
        ).
      map { |p| [ p.name, p.id ] }
    end
  end

  def current_test_results
    test_results.where(year: TimeExt.current_year, school_branch_id: school_branch_id)
  end

  def has_test_results_for_current_year?
    current_test_results.count > 0
  end

  def get_toppers_array_for_bar_chart
    get_array_for_bar_chart(aggregate_method: "max", order: "DESC")
  end

  def get_lowest_scorers_array_for_bar_chart
    get_array_for_bar_chart(aggregate_method: "min", order: "ASC")
  end

  private

  def get_array_for_bar_chart(aggregate_method: "max", order: "DESC")
    test_results_array = []

    results = current_test_results.includes(:student, :class_room, :class_test).select(
        "#{aggregate_method}(percentage) as percentage, student_id, class_room_id, class_test_id"
      ).group(
        "student_id, class_room_id, class_test_id"
      ).order("percentage #{order}").limit(DEFAULT_CHART_LIMIT + 2)

    results.each do |test_result|
      test_results_array << {
          unit: " #{test_result.student.name_with_rno}/#{test_result.class_room.full_name}/#{test_result.class_test.name}",
          value:  test_result.percentage
        }
    end
    test_results_array
  end
end
