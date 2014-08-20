require 'active_support/concern'

module Charts
  module BarChart
    extend ActiveSupport::Concern

    included do
      before_action :set_common_chart_data_for_class_room_charts, only: [
          :chart_for_class_room_toppers_testwise,
          :chart_for_class_room_lowest_scorers_testwise,
          :chart_for_class_room_toppers_subjectwise,
          :class_room_tests_pass_fail_details
        ]

      before_action :set_common_chart_data_for_class_test_charts, only: [
          :class_test_toppers,
          :class_test_lowest_scorers,
          :class_test_subjectwise_toppers,
          :class_test_subjectwise_lowest_scorers
        ]

      before_action :set_common_chart_data_for_subjects_charts, only: [
          :subject_toppers,
          :subject_lowest_scorers
        ]

      before_action :set_common_chart_data_for_students_charts, only: [
          :student_toppers,
          :student_lowest_scorers,
          :student_overall_performance,
          :tests_score,
          :subjects_score,
          :subjects_yearwise_score
        ]

    end

    module ClassMethods
    end

    def chart_for_latest_test_results
      chart_type                                  = params[:chart_type] || DEFAULT_CHART_TYPE
      js_chart                                    = default_chart_hash(chart_type)
      class_room                                  = current_school_branch.test_results.last.class_room
      js_chart["JSChart"]["datasets"][0]["data"]  = test_results_for_class_room(class_room)

      respond_to do |format|
        format.json { render json: js_chart }
      end
    end

    def chart_for_class_room
      chart_type                                  = params[:chart_type] || DEFAULT_CHART_TYPE
      js_chart                                    = default_chart_hash(chart_type)
      class_room                                  = ClassRoom.find params[:id]
      js_chart["JSChart"]["datasets"][0]["data"]  = test_results_for_class_room(class_room)

      respond_to do |format|
        format.json { render json: js_chart }
      end
    end

    def chart_for_class_room_toppers_subjectwise
      @js_chart["JSChart"]["datasets"][0]["data"]  =
        @class_room.get_toppers_array_subjectwise_for_bar_chart

      respond_to do |format|
        format.json { render json: @js_chart }
      end
    end

    def chart_for_class_room_toppers_testwise
      @js_chart["JSChart"]["datasets"][0]["data"]  =
        @class_room.get_toppers_array_testwise_for_bar_chart

      respond_to do |format|
        format.json { render json: @js_chart }
      end
    end

    def chart_for_class_room_lowest_scorers_testwise
      @js_chart["JSChart"]["datasets"][0]["data"]  =
        @class_room.get_lowest_scorers_array_testwise_for_bar_chart

      respond_to do |format|
        format.json { render json: @js_chart }
      end
    end

    def class_room_tests_pass_fail_details
      @js_chart["JSChart"]["datasets"][0]["data"]  =
        @class_room.get_pass_fail_tests_details_for_pie_chart(params[:class_test_id])

      respond_to do |format|
        format.json { render json: @js_chart }
      end
    end

    include Charts::BarChartForClassTest
    include Charts::BarChartForSubjects
    include Charts::BarChartForStudents

    protected

    def test_results_for_class_room(class_room)
      test_results = TestResult.where(class_room_id: class_room.id, year: TimeExt.current_year)
      class_test_ids = test_results.order("id").pluck(:class_test_id).uniq

      average_test_results = []

      class_test_ids.each do |class_test_id|
        test_result = test_results.where(class_test_id: class_test_id).select("avg(percentage) as percent, class_test_id").group("class_test_id").first

        average_test_results << {
            unit: test_result.class_test.name,
            value:  test_result.percent
          }
      end
      average_test_results
    end

    def set_common_chart_data_for_class_room_charts
      chart_type = params[:chart_type] || DEFAULT_CHART_TYPE
      @js_chart   = default_chart_hash(chart_type)
      @class_room = ClassRoom.find params[:id]
    end

  end
end