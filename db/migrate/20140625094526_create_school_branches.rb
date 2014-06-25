class CreateSchoolBranches < ActiveRecord::Migration
  def change
    create_table :school_branches do |t|
      t.string :name
      t.text :address
      t.string :city
      t.string :state
      t.string :zip

      t.timestamps
    end
  end
end
