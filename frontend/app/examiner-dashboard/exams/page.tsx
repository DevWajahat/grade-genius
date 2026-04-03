'use client';

import React from "react"

import { useState } from 'react';
import { Button } from '@/components/ui/button';
import { Card } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Textarea } from '@/components/ui/textarea';
import { Label } from '@/components/ui/label';
import ExaminerNav from '@/components/examiner-nav';
import { dummyExams, dummyHalls } from '@/lib/dummy-data';
import { Plus, Edit2, Trash2, Eye, Copy, Calendar } from 'lucide-react';
import { useRouter } from 'next/navigation';

export default function ExamsPage() {
  const router = useRouter();
  const exams = dummyExams;

  return (
    <div className="min-h-screen bg-background">
      <ExaminerNav />

      <main className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {/* Header */}
        <div className="flex items-center justify-between mb-8">
          <div>
            <h1 className="text-3xl font-bold text-foreground">Manage Exams</h1>
            <p className="text-foreground/60 mt-2">Create and manage your exams</p>
          </div>
          <Button 
            onClick={() => router.push('/examiner-dashboard/create-exam')}
            className="bg-primary hover:bg-primary/90 gap-2"
          >
            <Plus className="w-4 h-4" />
            New Exam
          </Button>
        </div>

        {/* Exams List */}
        <div className="space-y-4">
          {exams.map(exam => {
            const hall = dummyHalls.find(h => h.id === exam.hallId);
            return (
              <Card key={exam.id} className="border-border/50 p-6 hover:shadow-lg transition-shadow">
                <div className="flex items-start justify-between gap-6">
                  <div className="flex-1">
                    <h3 className="text-lg font-bold text-foreground">{exam.title}</h3>
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                      <div>
                        <p className="text-xs text-foreground/60 uppercase tracking-wider mb-1">Hall</p>
                        <p className="font-medium text-foreground">{hall?.name}</p>
                      </div>
                      <div>
                        <p className="text-xs text-foreground/60 uppercase tracking-wider mb-1">Details</p>
                        <p className="font-medium text-foreground">{exam.duration} min • {exam.totalMarks} marks</p>
                      </div>
                      <div>
                        <p className="text-xs text-foreground/60 uppercase tracking-wider mb-1">Sections</p>
                        <p className="font-medium text-foreground">{exam.sections.length} sections</p>
                      </div>
                    </div>
                  </div>

                  <div className="flex items-center gap-2">
                    <span className={`px-3 py-1 rounded-full text-xs font-medium whitespace-nowrap ${
                      exam.status === 'active' 
                        ? 'bg-primary/20 text-primary'
                        : exam.status === 'scheduled'
                        ? 'bg-secondary/20 text-secondary'
                        : 'bg-muted text-foreground/60'
                    }`}>
                      {exam.status.charAt(0).toUpperCase() + exam.status.slice(1)}
                    </span>
                  </div>
                </div>

                <div className="flex gap-2 mt-6 pt-6 border-t border-border/30">
                  <Button size="sm" variant="outline" className="border-border/50 gap-2 bg-transparent">
                    <Eye className="w-4 h-4" />
                    Preview
                  </Button>
                  <Button size="sm" variant="outline" className="border-border/50 gap-2 bg-transparent">
                    <Edit2 className="w-4 h-4" />
                    Edit
                  </Button>
                  <Button size="sm" variant="outline" className="border-border/50 gap-2 bg-transparent">
                    <Copy className="w-4 h-4" />
                    Duplicate
                  </Button>
                  <Button size="sm" variant="outline" className="border-border/50 gap-2 ml-auto text-destructive hover:text-destructive bg-transparent">
                    <Trash2 className="w-4 h-4" />
                    Delete
                  </Button>
                </div>
              </Card>
            );
          })}
        </div>
      </main>
    </div>
  );
}
